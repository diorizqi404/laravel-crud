<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index()
    {
        // mengambil data untuk chart dari tabel siswa dan kota dengan group by kota dan count total siswa per kota
        /** ex: 
         * [ 
         * ['kota' => 'Jakarta', 'total' => 10],
         * ['kota' => 'Bandung', 'total' => 20],
         * ['kota' => 'Surabaya', 'total' => 30],
         * ]
         **/
        $dataChart = DB::table('siswa')
            ->join('kota', 'siswa.Kota_ID', '=', 'kota.id')
            ->select('kota.NamaKota as kota', DB::raw('count(*) as total'))
            ->groupBy('kota.NamaKota')
            ->get()
            ->toArray();

        $dataTahunChart = DB::table('siswa')
            ->select(DB::raw('YEAR(TanggalLahir) as tahun'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEAR(TanggalLahir)'))
            ->orderBy('total', 'desc')
            ->get()
            ->toArray();
        $labelsYear = array_column($dataTahunChart, 'tahun');
        $dataTotalYear = array_column($dataTahunChart, 'total');

        $jumlahKota = DB::table('kota')->count();
        $jumlahSiswa = DB::table('siswa')->count();
        $jumlahSiswaLaki = DB::table('siswa')->where('JenisKelamin', 'Laki-laki')->count();
        $jumlahSiswaPerempuan = DB::table('siswa')->where('JenisKelamin', 'Perempuan')->count();
        return view('dashboard')
            ->with('jumlahKota', $jumlahKota)
            ->with('jumlahSiswa', $jumlahSiswa)
            ->with('jumlahSiswaLaki', $jumlahSiswaLaki)
            ->with('jumlahSiswaPerempuan', $jumlahSiswaPerempuan)
            ->with('dataChart', $dataChart)
            ->with('labelsYear', $labelsYear)
            ->with('dataTotalYear', $dataTotalYear);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
