<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;
use Illuminate\Support\Facades\Session;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil data dari tabel kota dengan pagination 5 data
        $kota = Kota::orderBy('id', 'asc')->paginate(5);

        // mengirim data ke view index
        return view('kota')->with('kota', $kota);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // menyimpan data inputan ke dalam session
        Session::flash('namakota', $request->namakota);

        $request->validate([
            'namakota' => 'required|unique:kota,NamaKota',
        ], [
            // pesan error
            'namakota.required' => 'Nama Kota tidak boleh kosong',
            'namakota.unique' => 'Nama Kota sudah terdaftar',
        ]);

        // mengambil data dari form inputan        
        $kota = [
            'NamaKota' => $request->namakota,
        ];

        kota::create($kota);

        // menghapus session
        $request->session()->forget(['namakota']);

        // redirect ke halaman data dengan pesan sukses
        return redirect()->route('kota')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
