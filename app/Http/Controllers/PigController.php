<?php

namespace App\Http\Controllers;

use App\Models\Pig;
use Illuminate\Http\Request;
use App\Models\Feed;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PigController extends Controller
{
    // Show Add Form (not used if form is inside dashboard)
    public function create()
    {
        return view('pigs.create');
    }

    public function edit(Pig $pig)
    {
        $feeds = Feed::all();
        return view('pigs.edit', compact('pig', 'feeds'));
    }

    public function show(Pig $pig)
    {
        return redirect()->route('dashboard');
    }

    public function destroy(Pig $pig)
    {
        $pig->delete();

        // Reset auto-increment if no active pigs exist (all moved to trash)
        if (Pig::count() === 0) {
            DB::statement("ALTER TABLE pigs AUTO_INCREMENT = 1");
        }

        return redirect()->route('dashboard')->with('success', 'Pig moved to trash!');
    }




    public function index(Request $request)
    {
        // Main query with filters
        $pigsQuery = Pig::with('feed')
            ->when($request->search, function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                    ->orWhere('type', 'like', '%' . $request->search . '%')
                    ->orWhere('purpose', 'like', '%' . $request->search . '%')
                    ->orWhereHas('feed', function ($feed) use ($request) {
                        $feed->where('feeds_name', 'like', '%' . $request->search . '%');
                    });
            })
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->type, fn($q) => $q->where('type', $request->type));

        // Get pigs (you can paginate if you want)
        $pigs = $pigsQuery->orderBy('id', 'asc')->get();

        // Dashboard statistics (NOT FILTERED)
        $totalDead = Pig::where('status', 'Dead')->count();
        $totalSold = Pig::where('status', 'Sold')->count();
        $totalSales = Pig::sum('price');

        // Feeds
        $feeds = Feed::all();

        return view('dashboard', compact(
            'pigs',
            'totalDead',
            'totalSold',
            'totalSales',
            'feeds'
        ));
    }

    public function exportPdf(Request $request)
    {
        // Same filters as dashboard
        $pigs = Pig::query()
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->latest()
            ->get();

        $date = now()->format('Y-m-d_H-i');

        $pdf = Pdf::loadView('pigs.export-pdf', compact('pigs'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("piggery-report-{$date}.pdf");
    }




    public function store(Request $request)
    {
        $request->validate([
            'weight'  => 'required|numeric|min:1',
            'status'  => 'required|in:Healthy,Sick,Sold,Dead',
            'type'    => 'required|in:Sow,Boar,Piglet,Fattening Pig',
            'purpose' => 'required|in:Breeding pigs,Meat pigs,Show pigs',
            'price'   => 'nullable|numeric|min:0',
            'feed_id' => 'required|exists:feeds,id',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pigs', 'public');
        }

        // Create pig with auto-increment
        Pig::create([
            'weight'  => $request->weight,
            'status'  => $request->status,
            'type'    => $request->type,
            'purpose' => $request->purpose,
            'price'   => $request->price ?: null,
            'feed_id' => $request->feed_id,
            'photo'   => $photoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pig added successfully!');
    }


    public function update(Request $request, Pig $pig)
    {
        $request->validate([
            'weight'  => 'required|numeric|min:1',
            'status'  => 'required|in:Healthy,Sick,Sold,Dead',
            'type'    => 'required|in:Sow,Boar,Piglet,Fattening Pig',
            'purpose' => 'required|in:Breeding pigs,Meat pigs,Show pigs',
            'price'   => 'nullable|numeric|min:0', // new validation for price
            'feed_id' => 'required|exists:feeds,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = [
            'weight'  => $request->weight,
            'status'  => $request->status,
            'type'    => $request->type,
            'purpose' => $request->purpose,
            'price'   => $request->price ?: null, // update price
            'feed_id' => $request->feed_id,
        ];

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($pig->photo) {
                Storage::disk('public')->delete($pig->photo);
            }

            $updateData['photo'] = $request->file('photo')->store('pigs', 'public');
        }

        $pig->update($updateData);

        return redirect()->route('dashboard')->with('success', 'Pig updated successfully!');
    }

    public function trash()
    {
        $trashedPigs = Pig::onlyTrashed()->with('feed')->get();
        return view('pigs.trash', compact('trashedPigs'));
    }

    public function restore($id)
    {
        $pig = Pig::withTrashed()->findOrFail($id);
        $pig->restore();

        return redirect()->route('pigs.trash')->with('success', 'Pig restored successfully!');
    }



    public function forceDelete($id)
    {
        $pig = Pig::withTrashed()->findOrFail($id);

        // Delete photo if exists
        if ($pig->photo) {
            Storage::disk('public')->delete($pig->photo);
        }

        $pig->forceDelete();

        // Reset auto-increment if no pigs exist at all
        if (Pig::withTrashed()->count() === 0) {
            DB::statement("ALTER TABLE pigs AUTO_INCREMENT = 1");
        }

        return redirect()->route('pigs.trash')->with('success', 'Pig permanently deleted!');
    }
}
