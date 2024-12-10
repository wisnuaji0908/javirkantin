@extends('layout.main')
@section('title', "Dashboard")
@section('content')
	@include('sweetalert::alert')
	<!-- Sisi Penjual -->
	@if (auth()->user())
			<h1>Welcome Back! {{ auth()->user()->name }}</h1>
		@endif

		@if(auth()->user()->role=='admin')

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<div class="container-fluid">
							<div class="row">
							<div class="col-sm-6">
								<h3 class="mt-2">Table Penjualan Harian</h3>
							</div><!-- /.col -->
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
								<li class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></li>
								</ol>
							</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.container-fluid -->
					</div>

						<div class="card-body">
							<div>

							</div>
							@if($order)

							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Barang</th>
										<th>Harga</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($order as $o)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $o->nama_barang }}</td>
										<td>{{ $o->harga }}</td>
										<td>{{ $o->getStatusLabel() }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							@endif

						</div>
					</div>
			</div>
		</div>

		@endif

		<!-- End Sisi Penjual -->
		<!-- ============================================================================ -->
		<!-- Sisi Pembeli -->
		@if(auth()->user()->role=='member')

		<div class="pembeli">
			<!-- Card -->
			<div class="row">
				<div class="col-lg-4 col-4">
					<!-- small box -->
					<div class="small-box bg-gradient-success">
						<div class="inner">
							<h3>{{ $order }}</h3>
							<p>Orderan Kamu</p>
						</div>
						<div class="icon">
							<i class="fas fa-bookmark"></i>
						</div>
						<a href="/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-4">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>{{ $proses }}</h3>
							<p>Orderan Kamu Yang Diproses</p>
						</div>
						<div class="icon">
							<i class="fas fa-shopping-cart"></i>
						</div>
						<a href="/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-4">
					<!-- small box -->
					<div class="small-box bg-gradient-danger">
						<div class="inner">
							<h3>{{ $belom }}</h3>
							<p>Pesanan yang belum diambil</p>
						</div>
						<div class="icon">
							<i class="fas fa-shopping-bag"></i>
						</div>
						<a href="/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>

			<!-- Katalog -->
			<section class="">
				<div>
					<div style="text-align: center;"><h2 class="font-weight-bold" style="font-size: 25px;">Kantin Virtual</h2></div>
				</div>

				<hr>
				<!-- ?? -->

				<div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 justify-content-center  g-3">
					<div class="col">
						<div class="card shadow-sm">
							<img src="/image/mm.png"  alt="Product">
							<div class="card-body">
								<p class="card-text fs-5 fw-normal"><b></b></p>
							</div>

							<div class="card-footer">
								<a href="/order?order=MM" class="btn btn-sm btn-link">
									<span>Detail Produk</span>
								</a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="/image/tp.png" width="100%" height="40%" alt="Product">

							<div class="card-body">
								<input type="hidden" name="id" value="">
							</div>

							<div class="card-footer">
								<a href="/order?order=TP" class="btn btn-sm btn-link" >
									<span>Detail Produk</span>
								</a>

								<!-- Modal -->
								<div class="modal fade" id="show">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Produk : <strong></strong></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-6">
													<span>

														<img  width="100%" heght="100%" src=''>
													</span>
												</div>
												<div class="col-6">
													<div class="table-responsive">
														<table class="table align-middle">
															<thead>
																<tr></tr>
															</thead>
															<tbody>
																<tr>
																	<td>Nama Produk</td>
																	<td></td>
																</tr>
																<tr>
																	<td>Harga Produk</td>
																	<td></td>
																</tr>
																<tr>
																	<td>Stok</td>
																	<td></td>
																</tr>
																<tr>
																	<td>Deskripsi Produk</td>
																	<td></td>
																</tr>
																@foreach($profile as $p)
																<tr>
																	<td>Nama Toko</td>
																	<td></td>
																</tr>
																<tr>
																	<td>Lokasi</td>
																	<td>Kantin </td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<a href="/wishlist/create" type="submit" class="btn btn-primary">Wishlist Here</a>
											<a href="/order/create" type="submit" class="btn btn-primary">Order Here</a>
										</div>
										</div>
									</div>
								</div>
								<!-- End Modal -->
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		@endif
		<!-- End Sisi Pembeli -->

@endsection
