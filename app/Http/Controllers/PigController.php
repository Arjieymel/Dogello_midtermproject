<?php

namespace App\Http\Controllers;

use App\Models\Pig;
use Illuminate\Http\Request;
use App\Models\Feed;

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

    public function destroy(Pig $pig)
    {
        $pig->delete();

        return redirect()->route('dashboard')->with('success', 'Pig deleted!');
    }


    public function index()
    {
        $pigs = Pig::all(); // fetch all pigs
        $feeds = Feed::all();
        $totalDead = Pig::where('status', 'Dead')->count();
        $totalSold = Pig::where('status', 'Sold')->count(); // total dead pigs
        $totalSales = $pigs->sum('price');


        return view('dashboard', compact('pigs', 'totalDead', 'totalSales', 'totalSold', 'feeds'));
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
        ]);

        Pig::create([
            'weight'  => $request->weight,
            'status'  => $request->status,
            'type'    => $request->type,
            'purpose' => $request->purpose,
            'price'   => $request->price ?: null, // store null if empty
            'feed_id' => $request->feed_id,
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
        ]);

        $pig->update([
            'weight'  => $request->weight,
            'status'  => $request->status,
            'type'    => $request->type,
            'purpose' => $request->purpose,
            'price'   => $request->price ?: null, // update price
            'feed_id' => $request->feed_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pig updated successfully!');
    }
}
