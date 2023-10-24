<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NoteController extends Controller
{
    public function index()
    {
        try {
            $notes = Note::all();
            return response()->json($notes, 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal mengambil catatan.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $note = new Note;
            $note->judul = $request->input('judul');
            $note->isi = $request->input('isi');
            $note->tanggal = $request->input('tanggal');
            $note->save();

            return response()->json($note, 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal menyimpan catatan.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $note = Note::findOrFail($id);
            return response()->json($note, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Catatan tidak ditemukan.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->judul = $request->input('judul');
            $note->isi = $request->input('isi');
            $note->tanggal = $request->input('tanggal');
            $note->save();

            return response()->json($note, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Catatan tidak ditemukan.'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal memperbarui catatan.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();
            return response()->json(['message' => 'Catatan berhasil dihapus'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Catatan tidak ditemukan.'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal menghapus catatan.'], 500);
        }
    }
}
