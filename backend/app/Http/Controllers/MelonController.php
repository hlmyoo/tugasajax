<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Melon;        

class MelonController extends Controller
{
    public function index()
    {
        $melons = Melon::all();
        return response()->json($melons, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'jenis_melon' => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
        ]);

        $melon = Melon::create([
            'nama'        => $request->nama,  
            'jenis_melon' => $request->jenis_melon, 
            'harga'       => $request->harga, 
            'stok'        => $request->stok,  
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data melon berhasil ditambahkan!',
            'data'    => $melon
        ], 201);
    }
}