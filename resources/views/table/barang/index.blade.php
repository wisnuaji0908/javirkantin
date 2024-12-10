@extends('layout.main')
@section('title', "Tabel Barang")
@section('content')
	@include('sweetalert::alert')

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
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Tambah Data</button>
							<div class="modal fade" id="modal-default">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Tambah Data</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="modal-body">
												<form action="/table/barang" method="post" enctype="multipart/form-data">
													@csrf
													<div class="form-floating mb-3">
														<label for="floatingInput3">Nama Barang</label>
														<input required name="barang" type="text" required class="form-control" id="floatingInput3">
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Harga</label>
														<input required name="harga" type="number" required class="form-control" id="floatingInput3">
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Stok</label>
														<input required name="stok" type="number" required class="form-control" id="floatingInput3">
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Deskripsi Barang</label>
                                                        <textarea name="desc_barang" placeholder="Deskripsi Toko" class="form-control"> </textarea>
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Pilih Cover Item</label>
														<input type="file" id="floatingInput3" name="photo" required class="form-control">
														<!-- <input required name="stok" type="image" required class="form-control" id="floatingInput3"> -->
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
                                    <th>No</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Deksripsi</th>
									<th>Photo</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
                                <tr>
									@foreach ($barang as $b)
                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="modalEditData{{$b->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Data </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        <form action="/table/barang/{{$b->id }}" method="post" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Nama Barang</label>
                                                                <input required name="barang" value="{{ $b->barang }}" type="text" required class="form-control" id="floatingInput3">
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Harga</label>
                                                                <input required name="harga"  value="{{ $b->harga }}" type="number" required class="form-control" id="floatingInput3">
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Stok</label>
                                                                <input required name="stok"  value="{{ $b->stok }}" type="number" required class="form-control" id="floatingInput3">
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <label for="floatingInput3">Deskripsi Barang</label>
                                                                <textarea name="desc_barang" placeholder="Deskripsi Toko" class="form-control"> {{ $b->desc_barang }} </textarea>
                                                            </div>
															
															<div class="form-floating mb-3">
																<label for="floatingInput3">Pilih Cover Item</label>
																<input type="file" id="floatingInput3" value="" name="photo" required class="form-control">
																<!-- <input required name="stok" type="image" required class="form-control" id="floatingInput3"> -->
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
                                    <td>{{$b->barang}}</td>
                                    <td>{{$b->harga}}</td>
                                    <td>{{$b->stok}}</td>
                                    <td>{{$b->desc_barang}}</td>
									<td><img src="{{ asset('photos/'. $b->photo) }}" width="50px"></td>
                                    <td>
                                        <a href="#modalEditData{{ $b->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
										</a>

										<form action="{{ route('barang.destroy', $b->id) }}" method="POST" class="d-inline">
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
