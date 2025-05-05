<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('activities', compact('activities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $activity = Activity::create([
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
        $activity = Activity::findOrFail($id);
        $activity->activity_name = $request->input('activity_name');
        $activity->location = $request->input('location');
        $activity->date = $request->input('date');
        $activity->save();

        return response()->json(['activity' => $activity]);
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return response()->json(['message' => 'Activity deleted successfully!']);
    }

    public function updateStatus(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->status = $request->status;
        $activity->save();

        return response()->json(['success' => true]);
    }

    public function manage($id)
    {
        $activity = Activity::findOrFail($id);

        // Return a view with activity details
        return view('admin.manage', compact('activity'));
    }
}
