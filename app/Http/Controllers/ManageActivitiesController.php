<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Events;

class ManageActivitiesController extends Controller
{
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('admin.manage', compact('activity'));
    }

    public function showw($id)
    {
        $activity = Events::findOrFail($id);
        return view('president.manage', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update($request->all());

        return redirect()->route('admin.manage', $id)->with('success', 'Activity updated successfully.');
    }
}
