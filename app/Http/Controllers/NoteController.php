<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = $request->q;
        $notes = Note::where('excerpt', 'LIKE', "%{$query}%" )
                 ->latest()->get();
        $queryParams = $request->query();
        return Inertia::render('Notes/Index', compact('notes', 'queryParams'));

        // $query = $request->q;
        // $notes = Note::where('excerpt', 'LIKE', "%{$query}%" )
        //         ->latest()->get();

        // return Inertia::render('Notes/Index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Notes/Partials/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'excerpt' => ['required', 'string', 'max:140'],
            'content' => ['required', 'string', 'max:1200']
        ]);

        $note = new Note;
        $note->create([
            'excerpt' => $request->excerpt,
            'content' => $request->content,
        ]);

        return to_route('notes.index')->with('status', 'Nota creada de forma exitosa');;

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return Inertia::render('Notes/Partials/Show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return Inertia::render('Notes/Partials/Edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'excerpt' => ['required', 'string', 'max:140'],
            'content' => ['required', 'string', 'max:1200']
        ]);

        $note->update([
            'excerpt' => $request->excerpt,
            'content' => $request->content,
        ]);

        return to_route('notes.index')->with('status', 'Nota actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return to_route('notes.index')->with('status', 'Nota Eliminada');
    }

}
