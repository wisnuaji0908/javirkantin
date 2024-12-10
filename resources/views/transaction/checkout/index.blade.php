@extends('layout.main')
@section('title', "Transaksi Checkout")
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
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>status</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($profile as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama_barang }}</td>
                                    <td>{{ $p->harga }}</td>
                                    <td><span class="badge badge-success">{{ $p->status }}</span></td>
                                </tr>

								@endforeach

							</tbody>
						</table>



					</div>
				</div>
		</div>
	</div>


@endsection
