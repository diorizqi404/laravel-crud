@extends('layout.adminlte')
{{-- @extends('components.message') --}}
@section('content')
{{-- content-wrapper wajib ada --}}
<div class="content-wrapper">
@component('components.message')
@endcomponent
	
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
	</div>
	
        <div class="card">
            {{-- <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
							</div> --}}
							<!-- /.card-header -->

							<div class="card-body">
								<button class="btn btn-primary mb-2" id="tambahDataBtn">+ Tambah Kota</button>

								{{-- FORM INPUT NAMA KOTA --}}
								<div id="formTambahData" style="display: none;">
									<form action='{{ route('storeKota') }}' method='post'>
										@csrf
										<div class="my-3 p-3 bg-body rounded shadow-sm">
												<div class="mb-3 row">
														<label for="nis" class="col-sm-2 col-form-label">Nama Kota</label>
														<div class="col-sm-10">
																<input type="text" class="form-control" name='namakota' id="namakota"
																		value="{{ Session::get('namakota') }}">
														</div>
												</div>
												<div class="mb-3 row">
														<div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
												</div>
										</div>
									</form>
								</div>
								{{-- END FORM --}}

							<script>
								document.addEventListener("DOMContentLoaded", function() {
									var formTambahData = document.getElementById("formTambahData");
									var tambahDataBtn = document.getElementById("tambahDataBtn");

									// Check if form visibility is stored in localStorage
									var isFormVisible = localStorage.getItem("formVisibility");

									// Set initial form visibility based on stored value
									if (isFormVisible === "true") {
										formTambahData.style.display = "block";
									} else {
										formTambahData.style.display = "none";
									}

									// Toggle form visibility on button click
									tambahDataBtn.addEventListener("click", function() {
										if (formTambahData.style.display === "none") {
											formTambahData.style.display = "block";
											localStorage.setItem("formVisibility", "true");
										} else {
											formTambahData.style.display = "none";
											localStorage.setItem("formVisibility", "false");
										}
									});
								});
							</script>

                <table id="example2" class="table table-bordered table-hover mb-2">
                    <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-1">Nama Kota</th>
                            <th class="col-md-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kota as $k)
                            <tr>
                                <td>{{ $k->id }}</td>
                                <td>{{ $k->NamaKota }}</td>
                                <td>
                                    {{-- <a href='{{ route('edit', ['nis' => $d->Nis]) }}' class="btn btn-warning btn-sm">Edit</a> --}}
                                    <a href='' class="btn btn-danger btn-sm">Del</a>
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
