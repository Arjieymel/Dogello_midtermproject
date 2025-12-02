<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a list of feeds.
     */
    public function index()
    {
        $feeds = Feed::all();
        return view('pigfeeds', compact('feeds'));
    }

    /**
     * Show the form for creating a new feed.
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created feed.
     */
    public function store(Request $request)
    {
        $request->validate([
            'feeds_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Feed::create([
            'feeds_name' => $request->feeds_name,
            'description' => $request->description,
        ]);

        return redirect()->route('pigfeeds')
            ->with('success', 'Feed added successfully!');
    }

    /**
     * Show the form for editing the specified feed.
     */
    public function edit(Feed $feed)
    {
        return view('feeds.editfeeds', compact('feed'));
    }

    /**
     * Update the specified feed.
     */
    public function update(Request $request, Feed $feed)
    {
        $request->validate([
            'feeds_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $feed->update([
            'feeds_name' => $request->feeds_name,
            'description' => $request->description,
        ]);

        return redirect()->route('pigfeeds')
            ->with('success', 'Feed updated successfully!');
    }

    /**
     * Remove the specified feed.
     */
    public function destroy(Feed $feed)
    {
        $feed->delete();

        return redirect()->route('pigfeeds')
            ->with('success', 'Feed deleted successfully!');
    }
}
