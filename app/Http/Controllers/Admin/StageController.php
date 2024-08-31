<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStageRequest;
use App\Http\Requests\UpdateStageRequest;
use App\Models\Day;
use App\Models\Mood;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StageController extends Controller
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
    public function create(Request $request)
    {
        $day_id = $request->query('day');

        if (!$day_id) {
            abort(404, "Day ID non trovato.");
        }

        $moods = Mood::all();

        return view('admin.stages.create' , compact('day_id' , 'moods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStageRequest $request)
    {
        $form_data = $request->validated();
        $day = Day::findOrFail($form_data['day_id']); 

        if ($day->user_id !== Auth::id()) {
            abort(403, "Non autorizzato a modificare questo viaggio.");
        }

        $form_data['user_id'] = Auth::user()->id;

        if ($request->has('mood')) {
            $form_data['mood_id'] = $request->mood;
        }

        $new_stage = Stage::create($form_data);

        return to_route('admin.stage.show', $new_stage);
}

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
        if ($stage->user_id !== Auth::id()) {
            return to_route('admin.trips.index');
        }
        $stage->load('day' , 'mood');

        $moods = Mood::all();

        return view('admin.stages.show', compact('stage', 'moods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        $moods = Mood::all();

        return view('admin.stages.edit', compact('stage' ,'moods' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStageRequest $request, Stage $stage)
    {
        $form_data = $request->validated();

        if ($stage->user_id !== Auth::id()) {
            return to_route('admin.trips.index');
        }

        if ($request->has('mood')) {
            $form_data['mood_id'] = $request->mood;
        }
        
        $stage->update($form_data);

        return to_route('admin.stages.show', $stage);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        $dayId = $stage->day_id;
        $stage->delete();

        return to_route('admin.days.show', $dayId);
    }
}
