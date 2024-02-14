@extends('layout.adminlte')
{{-- @extends('components.message') --}}
@section('content')
    {{-- content-wrapper wajib ada --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tabel Nama Kota</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            @component('components.message')
            @endcomponent
        </div>
        {{-- FORM TAMBAH DATA KOTA --}}
        <div class="card m-4 w-50">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#tambahDataModal">+ Tambah Data Kota</button>
                    </div>
                    <form action="{{ route('kota') }}" method="GET" class="d-flex mb-3 col-5">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="katakunci" value="{{ Request::get('katakunci') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan!!</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('storeKota') }}" method="POST" class="row g-4">
                                    @csrf
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Kota</label>
                                        <input type="text" class="form-control" id="inputEmail4" name="namakota"
                                            value="{{ Session::get('namakota') }}" placeholder="ex: Surabaya">
                                    </div>
                                    <div class="modal-footer d-flex pb-0">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
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
                            <th class="col-md-8">Nama Kota</th>
                            <th class="col-md-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kota as $k)
                            <tr>
                                <td>{{ $k->id }}</td>
                                <td>{{ $k->NamaKota }}</td>
                                <td>
																				<a href='{{ route('editKota', ['id' => $k->id]) }}'
																					class="btn btn-warning btn-sm p-1 pb-0"><span class="material-symbols-outlined text-white fs-3">
																						edit_square</span></a>
																			<!-- Button trigger modal -->
																			<button type="button" class="btn btn-danger btn-sm p-1 pb-0" data-bs-toggle="modal"
																					data-bs-target="#deleteModal"><span class="material-symbols-outlined text-white fs-3">
																						delete</span></button>
																</td>						

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
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('deleteKota', ['id' => $k->id]) }}"
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
                {{ $kota->links() }}
            </div>
            <!-- /.card-body -->

        </div>
    </div>
@endsection
