<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStageRequest;
use App\Http\Requests\UpdateStageRequest;
use App\Models\Day;
use App\Models\Mood;
use App\Models\Stage;
use App\Models\StageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

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
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('stages', 'public');
    
                StageImage::create([
                    'stage_id' => $new_stage->id,
                    'image_path' => $path,
                ]);
            }
        }
    
        return to_route('admin.days.show', $day->id);
    }
    

    /**
     * Display the specified resource.
     */

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
    
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = StageImage::findOrFail($imageId);
        
                $file_path = 'public/' . $image->image_path;
        
                Storage::delete($file_path);
        
                $image->delete();
            }
        }
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                
                $stage->images()->create(['image_path' => $path]);
            }
        }
    
        return to_route('admin.days.show', $stage->day->id);
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
{
    $dayId = $stage->day_id;

    foreach ($stage->images as $image) {
        Storage::disk('public')->delete($image->image_path);
        
        $image->delete();
    }

    $stage->delete();

    return to_route('admin.days.show', $dayId);
}
}
