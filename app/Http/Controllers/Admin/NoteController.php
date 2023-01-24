<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\NoteVersion;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index');
    }

    public function create()
    {
        return view('notes.create-edit');
    }

    public function store(Request $request)
    {
        $noteSlug = \Str::slug($request->title);
        $noteExists = Note::where('slug', $noteSlug)->first();

        if ($noteExists) {
            $noteSlug .= floor(microtime(true) * 1000);
        }

        $note = Note::create([
            'title' => $request->title,
            'slug' => $noteSlug
        ]);

        foreach ($request->versions_title as $key => $versionTitle) {
            NoteVersion::create([
                'note_id' => $note->id,
                'title' => $versionTitle,
                'description' => $request->versions_description[$key]
            ]);
        }

        return $note;
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);

        return view('notes.create-edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $noteSlug = \Str::slug($request->title);
        $noteExists = Note::where('slug', $noteSlug)->where('id', '!=', $id)->first();

        if ($noteExists) {
            $noteSlug .= floor(microtime(true) * 1000);
        }

        $note = Note::findOrFail($id);

        $note->update([
            'title' => $request->title,
            'slug' => $noteSlug
        ]);

        $note->versions()->forcedelete();
        foreach ($request->versions_title as $key => $versionTitle) {
            NoteVersion::create([
                'note_id' => $note->id,
                'title' => $versionTitle,
                'description' => $request->versions_description[$key]
            ]);
        }
    }

    public function destroy($id)
    {

    }
}
