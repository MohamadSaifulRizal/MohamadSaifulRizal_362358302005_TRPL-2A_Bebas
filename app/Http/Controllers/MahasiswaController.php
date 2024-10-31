<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
// use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return Mahasiswa::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required',
            'nim'=> 'required|unique:mahasiswas',
            'jurusan'=> 'required',
        ]);
        
        return Mahasiswa::create($request->all());
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return $mahasiswa;
    }

    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
