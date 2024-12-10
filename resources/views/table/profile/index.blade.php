@extends('layout.main')
@section('title', "Tabel Profile")
@section('content')
	@include('sweetalert::alert')

	@if (session('error'))
	<div class="alert alert-danger" role="alert">
		{{ session('error') }}
	  </div>
	@endif
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-6">
                            <h3 class="mt-2">@yield('title')</h3>
                          </div><!-- /.col -->
                          <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                              <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                          </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
				</div>

					<div class="card-body">
						<div>
							@if ($cek==0)
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Tambah Data</button>
							@endif
							<div class="modal fade" id="modal-default">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Tambah Data {{ $cek }}</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>

										<div class="modal-body">
											<div class="modal-body">
												<form action="/table/profile" method="post" enctype="multipart/form-data">
													@csrf
													<div class="form-floating mb-3">
														<label for="floatingInput3">Nama Toko</label>
														<input required name="nama_toko" type="text" required class="form-control" id="floatingInput3">
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Nomor Telpon</label>
														<input required name="nomor_telp" placeholder="+62" type="number" required class="form-control" id="floatingInput3">
													</div>
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput3">Lokasi</label>
                                                        <select class="form-select form-control" aria-label="Default select example" name="lokasi" required>
                                                            <option value="" selected disabled>Pilih Lokasi</option>
                                                            <option value="TP">Kantin TP</option>
                                                            <option value="MM">Kantin MM</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput3">Label Toko</label>
                                                        <select name="label" class="form-select form-control"  required>
															<option value="" selected disabled>Pilih Label</option>
                                                            <option value="Makanan">Makanan</option>
                                                            <option value="Minuman">Minuman</option>
                                                            <option value="ATK">ATK</option>
                                                            <option value="Dan lainnya">Dan lainnya</option>
                                                        </select>
                                                    </div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Deskripsi Toko</label>
                                                        <textarea name="deskripsi_toko" placeholder="Deskripsi Toko" class="form-control"> </textarea>
													</div>
													<div class="input-group">
														<button class="btn btn-success rounded me-1" type="submit">Submit</button>
													</div>
												</form>
											</div>
										</div>
										<div class="modal-footer justify-content-between">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No. Toko</th>
									<th>Nama Toko</th>
									<th>No. Telp</th>
									<th>Lokasi</th>
									<th>label</th>
									<th>Deskripsi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($profile as $p)
                                <tr>
                                    {{-- Modal Edit --}}
									<div class="modal fade" id="modalEditData{{$p->id }}">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Edit Data</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="modal-body">
														<form action="/table/profile/{{$p->id }}" method="post" enctype="multipart/form-data">
															@method('put')
															@csrf
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Nama Toko</label>
                                                                <input required name="nama_toko" value="{{ $p->nama_toko }}" type="text" required class="form-control" id="floatingInput3">
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Nomor Telpon</label>
                                                                <input required name="nomor_telp" value="{{ $p->nomor_telp }}"  placeholder="+62" type="number" required class="form-control" id="floatingInput3">
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Lokasi</label>
                                                                <select class="form-select form-control" aria-label="Default select example" name="lokasi" required>
                                                                    <option value="" disabled>Pilih Lokasi</option>
																	@foreach ($lokasi as $t)
                                                                    <option value="{{ $t }}" {{ $p->label === $t ? 'selected' : '' }}>Kantin {{ $t }}</option>
																	@endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-floating mb-3">
																<label for="floatingInput3">Label Toko</label>
																<select name="label" class="form-select form-control"  required>
                                                                    @foreach ($label as $t)
                                                                    <option value="{{ $t }}" {{ $p->label === $t ? 'selected' : '' }}>{{ $t }}</option>
																	@endforeach
                                                                </select>

																
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Deskripsi Toko</label>
                                                                <textarea name="deskripsi_toko" placeholder="Deskripsi Toko" class="form-control">{{ $p->deskripsi_toko }}</textarea>
                                                            </div>
                                                            <div class="input-group">
                                                                <button class="btn btn-success rounded me-1" type="submit">Submit</button>
                                                            </div>
														</form>
													</div>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama_toko }}</td>
                                    <td>{{ $p->nomor_telp }}</td>
                                    <td>{{ $p->lokasi }}</td>
                                    <td>
										@if ($p->label=="Makanan")
                                        <span class="badge bg-warning">{{ $p->label }}</span>
										@elseif ( $p->label=="Minuman")
                                        <span class="badge bg-primary">{{ $p->label }}</span>
										@elseif ( $p->label=="ATK" )
                                        <span class="badge bg-danger">{{ $p->label }}</span>
										@else
                                        <span class="badge bg-secondary">{{ $p->label }}</span>
										@endif
                                    </td>
                                    <td>{{ $p->deskripsi_toko }}</td>
                                    <td>
                                        <a href="#modalEditData{{ $p->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
										</a>
                                        {{-- <a href="#modalEditData{{ $school->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
										</a> --}}
										<form action="{{ route('profile.destroy', $p->id) }}" method="POST" class="d-inline">
											@method('delete')
											@csrf
											<button type="submit" onclick="return confirm('Sure?')" class="btn btn-outline-danger btn-sm">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
											</button>
										</form>
									</td>
                                </tr>

								@endforeach

							</tbody>
						</table>
					</div>
				</div>
		</div>
	</div>


@endsection
