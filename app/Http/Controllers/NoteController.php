<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index()
    {
        try {
            $notes = Note::all();
            return response()->json([
                'data' => $notes,
                'message' => 'Berhasil ambil data',
                'success' => true,
                'status' => 201,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan saat ambil data: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'id_user' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal.', 'errors' => $validator->errors()], 400);
        }
        try {
            $note=Note::create($request->all());

            return response()->json([
                'data' => $note,
                'message' => 'Berhasil menambah data',
                'success' => true,
                'status' => 201,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan saat menambah data: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $note = Note::findOrFail($id);
            return response()->json([
                'data' => $note,
                'message' => 'Berhasil ambil data berdasarkan id',
                'success' => true,
                'status' => 201,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Catatan tidak ditemukan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'id_user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal.', 'errors' => $validator->errors()], 400);
        }

        try {
            $note = Note::findOrFail($id);
            $note->judul = $request->input('judul');
            $note->isi = $request->input('isi');
            $note->id_user = $request->input('id_user');
            $note->update();


            return response()->json([
                'data' => $note,
                'message' => 'Berhasil ubah data',
                'success' => true,
                'status' => 201,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Catatan tidak ditemukan: ' . $e->getMessage(),
                'success' => false,
                'status' => 404,
            ], 404);
        }catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();
            return response()->json([
                'data' => $note,
                'message' => 'Berhasil hapus data',
                'success' => true,
                'status' => 201,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Catatan tidak ditemukan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Gagal Menghapus Catatan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }
}
