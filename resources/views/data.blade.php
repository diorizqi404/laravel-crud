@extends('layout.adminlte')
{{-- @extends('components.message') --}}
@section('content')
    {{-- content-wrapper wajib ada --}}
    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tabel Data Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @component('components.message')
        @endcomponent

        {{-- FORM TAMBAH DATA SISWA --}}
        <div class="card m-4">
            <div class="card-body">
							<div class="row">
								<div class="col-8">
									<button type="button" class="btn btn-primary mb-3 col-3" data-bs-toggle="modal" data-bs-target="#tambahDataModal">+ Tambah Data Siswa</button>
								</div>
								<form action="{{ route('data') }}" method="GET" class="d-flex mb-3 col-4">
										<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="katakunci" value="{{ Request::get('katakunci') }}">
										<button class="btn btn-outline-success" type="submit">Search</button>
								</form>
							</div>
								
                <!-- FORM MODAL	 -->
                <div class="modal" id="tambahDataModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content" style="width: 800px">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('storeData') }}" method="POST" class="row g-4">
                                    @csrf
                                    <div class="col-md-3">
                                        <label class="form-label">NIS</label>
                                        <input type="number" class="form-control" id="inputEmail4" name="nis"
                                            value="{{ Session::get('nis') }}" placeholder="ex: 1001">
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label">Nama Lengkap Siswa</label>
                                        <input type="text" class="form-control" id="inputPassword4" name="nama"
                                            value="{{ Session::get('nama') }}" placeholder="ex: Joko Widodo">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat Siswa</label>
                                        <input type="text" class="form-control" id="inputAddress"
                                            placeholder="ex: JL. Merdeka Raya No. 17" name="alamat"
                                            value="{{ Session::get('alamat') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" id="jeniskelamin" name="jeniskelamin">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki"
                                                {{ Session::get('jeniskelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ Session::get('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name='tanggal' id="tanggal"
                                            value="{{ Session::get('tanggal') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kota</label>
                                        <select class="form-select" id="kota" name="kota">
																					<option value="" selected>Pilih Kota</option>
                                            @if ($kota)
                                                @foreach ($kota as $id => $NamaKota)
                                                    <option value="{{ $id }}" {{ old('kota', Session::get('Kota_ID')) == $id ? 'selected' : '' }}>{{ $NamaKota }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="modal-footer d-flex">
																			<button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="example2" class="table table-bordered table-hover mb-2">
                    <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-1">NIS</th>
                            <th class="col-md-3">Nama</th>
                            <th class="col-md-1">Jenis Kelamin</th>
                            <th class="col-md-1">Tanggal Lahir</th>
                            <th class="col-md-2">Alamat</th>
                            <th class="col-md-1">Kota</th>
                            <th class="col-md-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->Nis }}</td>
                                <td>{{ $d->Nama }}</td>
                                <td>{{ $d->JenisKelamin }}</td>
                                <td>{{ $d->TanggalLahir }}</td>
                                <td>{{ $d->Alamat }}</td>
                                <td>{{ $d->Kota->NamaKota ?? 'Belum Terisi' }}</td>
                                <td>
                                    <a href='{{ route('editData', ['nis' => $d->Nis]) }}'
                                        class="btn btn-warning btn-sm p-1 pb-0"><span class="material-symbols-outlined text-white fs-3">
																					edit_square</span></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm p-1 pb-0" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><span class="material-symbols-outlined text-white fs-3">
																					delete</span></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Peringatan!!</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini?
                                                    <br>
                                                    Data yang terhapus tidak dapat dipulihkan!!
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger me-2"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('deleteData', ['nis' => $d->Nis]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
            <!-- /.card-body -->
						
        </div>
    </div>
@endsection
