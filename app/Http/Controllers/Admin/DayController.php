<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Models\Day;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $moods = Mood::all();

        return view('admin.days.create' , compact('moods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDayRequest $request)
    {
        $form_data = $request->validated();
        $form_data['user_id'] = Auth::user()->id;

        if ($request->has('mood')) {
            $form_data['mood_id'] = $request->mood;
        }

        $new_day = Day::create($form_data);

        return to_route('admin.days.show', $new_day);

    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
        if ($day->user_id !== Auth::id()) {
            return to_route('admin.trips.index');
        }

        $moods = Mood::all();

        return view('admin.days.show', compact('day', 'moods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Day $day)
    {
        return view('admin.days.show', compact('day'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDayRequest $request, Day $day)
    {
        $form_data = $request->validated();

        if ($day->user_id !== Auth::id()) {
            return to_route('admin.trips.index');
        }

        if ($request->has('mood')) {
            $form_data['mood_id'] = $request->mood;
        }
        
        $day->update($form_data);

        return to_route('admin.days.show', $day);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $tripId = $day->trip_id;
        $day->delete();

        return to_route('admin.trips.show', $tripId);
    }
}
