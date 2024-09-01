<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Day;
use App\Models\Note;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
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

        return view('admin.notes.create' , compact('day_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $form_data = $request->validated();
        $day = Day::findOrFail($form_data['day_id']); 

        if ($day->user_id !== Auth::id()) {
            abort(403, "Non autorizzato a modificare questo viaggio.");
        }

        $form_data['user_id'] = Auth::user()->id;
     
        $new_note = Note::create($form_data);

        return to_route('admin.days.show', $day->id);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {

        return view('admin.notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $form_data = $request->validated();

        if ($note->user_id !== Auth::id()) {
            return to_route('admin.trips.index');
        }
        
        $note->update($form_data);

        $day = $note->day;

        return to_route('admin.days.show', $day->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $dayId = $note->day_id;
        $note->delete();

        return to_route('admin.days.show', $dayId);
    }
}
