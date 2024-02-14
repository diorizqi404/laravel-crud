@extends('layout.adminlte')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="ms-4">Edit Data Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="ms-2 mt-2">
                    @component('components.message')
                    @endcomponent
                </div>
            </div><!-- /.container-fluid -->
        </div>
        
        <div class="w-25 m-5 mt-0 bg-white shadow rounded p-4">
            <form action="{{ route('updateKota', ['id' => $kota->id]) }}" method="POST" class="row g-4">
                @csrf
                @method('PUT')
                <div class="col-md-3">
                    <label class="form-label">ID</label>
                    <input type="number" class="form-control" name="id" value="{{ $kota->id }}"
                        placeholder="ex: 1001" disabled>
                </div>
                <div class="col-md-9">
                    <label class="form-label">Nama Kota</label>
                    <input type="text" class="form-control" name="namakota"
                        value="{{ $kota->NamaKota }}" placeholder="ex: Surabaya">
                </div>
                <div class="modal-footer d-flex">
                    <a href="{{ url('dashboard/kota') }}" class="btn btn-danger me-2">Batal</a>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
