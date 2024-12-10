@extends('layout.main')
@section('title', "Wishlist")
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
							<a href="/wishlist/create" type="button" class="btn btn-default">Tambah Data</a>
						</div>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
                                    <th>No</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Deksripsi</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
                                <tr>
									
								</tr>
							</tbody>
						</table>
					</div>
				</div>
		</div>
	</div>


@endsection
