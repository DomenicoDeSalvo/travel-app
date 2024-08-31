<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logged_user_id = Auth::user()->id;
        $trips = Trip::where('user_id', $logged_user_id)->get();

        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.trips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $form_data = $request->validated();
        $form_data['user_id'] = Auth::user()->id;

        if ($request->hasFile('thumb')) {
            $image_path = Storage::disk('public')->put('thumb_images', $request->thumb);
            $form_data['thumb'] = $image_path;
        }

        $new_trip = Trip::create($form_data);

        return to_route('admin.trips.show', $new_trip);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {

        if ($trip->user_id !== Auth::id()) {
            return to_route('admin.trips.index');
        }

        return view('admin.trips.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {

        if ($trip->user_id !== Auth::id()) {
            return to_route('admin.trips.index');
        }

        return view('admin.trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $form_data = $request->validated();

        if ($request->hasFile('thumb')) {
            $image_path = Storage::disk('public')->put('thumb_images', $request->thumb);
            $form_data['thumb'] = $image_path;
        }

        $trip->update($form_data);

        return to_route('admin.trips.show', $trip);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return to_route('admin.trips.index');
    }
}
