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
        
        <div class="w-75 m-5 mt-0 bg-white shadow rounded p-4">
            <form action="{{ route('updateData', ['nis' => $data->Nis]) }}" method="POST" class="row g-4">
                @csrf
                @method('PUT')
                <div class="col-md-3">
                    <label class="form-label">NIS</label>
                    <input type="number" class="form-control" id="inputEmail4" name="nis" value="{{ $data->Nis }}"
                        placeholder="ex: 1001" disabled>
                </div>
                <div class="col-md-9">
                    <label class="form-label">Nama Lengkap Siswa</label>
                    <input type="text" class="form-control" id="inputPassword4" name="nama"
                        value="{{ $data->Nama }}" placeholder="ex: Joko Widodo">
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat Siswa</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="ex: JL. Merdeka Raya No. 17"
                        name="alamat" value="{{ $data->Alamat }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jeniskelamin" name="jeniskelamin">
                        <option value="" selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ $data->JenisKelamin == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" {{ $data->JenisKelamin == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name='tanggal' id="tanggal"
                        value="{{ $data->TanggalLahir  }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kota</label>
                    <select class="form-select" id="kota" name="kota">
                        <option value="" selected>Pilih Kota</option>
                        @if ($kota)
                            @foreach ($kota as $id => $NamaKota)
                                <option value="{{ $id }}" {{ $id == $data->Kota_ID ? 'selected' : '' }}>
                                    {{ $NamaKota }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="modal-footer d-flex">
                    <a href="{{ url('dashboard/data') }}" class="btn btn-danger me-2">Batal</a>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
