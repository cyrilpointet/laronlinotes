<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);
        $user = $request->user();

        Note::create([
            'content' => $request->text,
            'user_id' => $user->id
        ]);

        $user->notes;

        return response($user, 201);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $note = Note::find($id);
        if (null === $note) {
            return response([
                "message" => "Note inconnue"
            ], 404);
        }

        $user = $request->user();
        if ($note->user_id !== $user->id) {
            return response([
                "message" => "Non proprietaire de la note"
            ], 401);
        }

        $note->content = $request->text;
        $note->save();

        $user->notes;

        return response($user, 201);
    }

    public function delete($id, Request $request)
    {
        $note = Note::find($id);
        if (null === $note) {
            return response([
                "message" => "Note inconnue"
            ], 404);
        }

        $user = $request->user();
        if ($note->user_id !== $user->id) {
            return response([
                "message" => "Non proprietaire de la note"
            ], 401);
        }

        $note->delete();

        $user->notes;

        return response($user, 201);
    }
}
