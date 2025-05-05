<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $activities = Events::all();
        return view('events', compact('events'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $activity = Events::create([
            'activity_name' => $validated['activity_name'],
            'location' => $validated['location'],
            'date' => $validated['date'],
        ]);

        return response()->json([
            'success' => true,
            'activity' => $activity,
        ]);
    }

    public function update(Request $request, $id)
    {
        $activity = Events::findOrFail($id);
        $activity->activity_name = $request->input('activity_name');
        $activity->location = $request->input('location');
        $activity->date = $request->input('date');
        $activity->save();

        return response()->json(['activity' => $activity]);
    }

    public function destroy($id)
    {
        $activity = Events::findOrFail($id);
        $activity->delete();

        return response()->json(['message' => 'Activity deleted successfully!']);
    }

    public function updateStatus(Request $request, $id)
    {
        $activity = Events::findOrFail($id);
        $activity->status = $request->status;
        $activity->save();

        return response()->json(['success' => true]);
    }

    public function manage($id)
    {
        $activity = Events::findOrFail($id);

        // Return a view with activity details
        return view('president.manage', compact('events'));
    }
}
