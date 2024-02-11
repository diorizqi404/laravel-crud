<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all NamaKota from the kota table
        $kota = kota::pluck('NamaKota', 'id');

        $katakunci = $request->katakunci;
        if(strlen($katakunci) ){
            $data = siswa::join('kota', 'siswa.Kota_ID', '=', 'kota.id')
                ->where('Nis', 'like', "%$katakunci%")
                ->orWhere('Nama', 'like', "%{$katakunci}%")
                ->orWhere('JenisKelamin', 'like', "%{$katakunci}%")
                ->orWhere('TanggalLahir', 'like', "%{$katakunci}%")
                ->orWhere('Alamat', 'like', "%{$katakunci}%")
                ->orWhere('kota.NamaKota', 'like', "%{$katakunci}%")
                ->select('siswa.*')
                ->paginate(10);
        }else {
            // mengambil data dari tabel siswa dengan pagination 5 data
            $data = Siswa::with('kota')->orderBy('Nis', 'asc')->paginate(10);
        }
        

        // mengirim data ke view index
        return view('data')->with('data', $data)->with('kota', $kota);
        return response()->json([
            'data' => $data,
            'kota' => $kota,
        ]);
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
        // Session::flash('nis', $request->nis);
        // Session::flash('nama', $request->nama);
        // Session::flash('jeniskelamin', $request->jeniskelamin);
        // Session::flash('tanggal', $request->tanggal);
        // Session::flash('alamat', $request->alamat);
        // Session::flash('Kota_ID', $request->kota);

        // validasi inputan 
        // $request->validate([
        //     'nis' => 'required|numeric|unique:siswa,Nis',
        //     'nama' => 'required',
        //     'jeniskelamin' => 'required|in:Laki-laki,Perempuan',
        //     'tanggal' => 'required',
        //     'alamat' => 'required',
        //     'kota' => 'required',
        // ], [
        //     // pesan error
        //     'nis.required' => 'Nis tidak boleh kosong',
        //     'nis.numeric' => 'Nis harus berupa angka',
        //     'nis.unique' => 'Nis sudah terdaftar',
        //     'nama.required' => 'Nama tidak boleh kosong',
        //     'jeniskelamin.required' => 'Jenis kelamin tidak boleh kosong',
        //     'jeniskelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
        //     'tanggal.required' => 'Tanggal lahir tidak boleh kosong',
        //     'alamat.required' => 'Alamat tidak boleh kosong',
        //     'kota.required' => 'Kota tidak boleh kosong',
        // ]);

        // mengambil data dari form inputan        
        // $data = [
        //     'Nis' => $request->nis,
        //     'Nama' => $request->nama,
        //     'JenisKelamin' => $request->jeniskelamin,
        //     'TanggalLahir' => $request->tanggal,
        //     'Alamat' => $request->alamat,
        //     'Kota_ID' => $request->kota,
        // ];

        // menyimpan data ke database
        // $siswa = siswa::create($data);

        // menghapus session
        // $request->session()->forget(['nis', 'nama', 'jeniskelamin', 'tanggal', 'alamat', 'kota']);

        // redirect ke halaman data dengan pesan sukses
        // return redirect()->route('data')->with('success', 'Data berhasil ditambahkan');
        
        $siswa = siswa::create([
            'Nis' => $request->Nis,
            'Nama' => $request->Nama,
            'JenisKelamin' => $request->JenisKelamin,
            'TanggalLahir' => $request->TanggalLahir,
            'Alamat' => $request->Alamat,
            'Kota_ID' => $request->Kota_ID,
        ]);
        
        return response()->json([
            'data' => $siswa,    
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan'
        ]);
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
    public function edit($nis)
    {
        // mengambil data siswa berdasarkan nis
        $data = siswa::where('Nis', $nis)->first();

        $kota = kota::pluck('NamaKota', 'id');

        // mengirim data ke view dataEdit
        return view('dataEdit')->with('data', $data)->with('kota', $kota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validasi inputan 
        // $request->validate([
        //     'nama' => 'required',
        //     'jeniskelamin' => 'required',
        //     'tanggal' => 'required',
        //     'alamat' => 'required',
        //     'kota' => 'required',
        // ], [
        //     // pesan error
        //     'nama.required' => 'Nama tidak boleh kosong',
        //     'jeniskelamin.required' => 'Jenis kelamin tidak boleh kosong',
        //     'tanggal.required' => 'Tanggal lahir tidak boleh kosong',
        //     'alamat.required' => 'Alamat tidak boleh kosong',
        //     'kota.required' => 'Kota tidak boleh kosong',
        // ]);

        // mengambil data dari form inputan
        $data = [
            // 'Nis' => $request->Nis,
            'Nama' => $request->Nama,
            'JenisKelamin' => $request->JenisKelamin,
            'TanggalLahir' => $request->TanggalLahir,
            'Alamat' => $request->Alamat,
            'Kota_ID' => $request->Kota_ID,
        ];

        // menyimpan data ke database
        Siswa::where('Nis', $id)->update($data);
        // $siswa = siswa::where('Nis', $nis)->first();
        return response()->json([
            'data' => $data,
            'status' => 'success',
            'message' => 'Data berhasil diedit',
        ]);

        // redirect ke halaman data dengan pesan sukses
        // return redirect()->route('data')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        siswa::where('Nis', $id)->delete();
        // return redirect()->route('data')->with('success', 'Data berhasil terhapus');
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil terhapus',
        ]);
    }
}
