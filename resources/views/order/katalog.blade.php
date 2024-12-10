@extends('layout.main')
@section('title', "Transaksi Order")
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
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div></div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profile as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama_barang }}</td>
                                <td>{{ $p->harga }}</td>
                                <td scope="col">
                                    <span class="badge {{ $p->getStatusBadgeClass() }}">{{ $p->getStatusLabel() }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">Cek Detail Informasi</button>
                                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModal1Label">Detail Pesanan</h5>
                                                    <!-- ! Close Button -->
                                                    <!-- <button type="button btn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mx-md-n3">
                                                        <div class="col px-md-5"><div class="p-2">Nama Pembeli</div></div>
                                                        <div class="col px-md-5"><div class="p-2">: {{ $p->user->name }}</div></div>
                                                    </div>
                                                    <div class="row mx-md-n3">
                                                        <div class="col px-md-5"><div class="p-2">Nama Barang</div></div>
                                                        <div class="col px-md-5"><div class="p-2">: {{ $p->nama_barang }}</div></div>
                                                    </div>
                                                    <div class="row mx-md-n3">
                                                        <div class="col px-md-5"><div class="p-2">Harga</div></div>
                                                        <div class="col px-md-5"><div class="p-2">: {{ $p->harga }}</div></div>
                                                    </div>
                                                    <div class="row mx-md-n3">
                                                        <div class="col px-md-5">
                                                            <div class="p-2">Notes</div>
                                                        </div>
                                                        <div class="col px-md-5">
                                                            <div class="p-2">
                                                                @if ($p->notes)
                                                                    : {{ $p->notes }}
                                                                @else
                                                                    : <strong>Tidak ada Notes untuk pesanan ini</strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mx-md-n3">
                                                        <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                        <div class="col px-md-5"><div class="p-2">:<span class="badge {{ $p->getStatusBadgeClass() }}">{{ $p->getStatusLabel() }}</span></div></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    @if($status)
                                                        @if($status==1)
                                                            <form action="/transaction/order/{{ $p->id }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="status" value="2">
                                                                <button type="submit" class="btn btn-warning">terima</button>
                                                            </form>
                                                            <form action="/transaction/order/{{ $p->id }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="status" value="5">
                                                                <button type="submit" class="btn btn-danger">tolak</button>
                                                            </form>
                                                        @endif
                                                        @if($status==2)
                                                            <form action="/transaction/order/{{ $p->id }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="status" value="3">
                                                                <button type="submit" class="btn btn-primary">siap diambil</button>
                                                            </form>
                                                            @endif
                                                            @if($status==3)
                                                            <form action="/transaction/order/{{ $p->id }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="status" value="4">
                                                                <button type="submit" class="btn btn-success">sudah selesai</button>
                                                            </form>
                                                            @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
