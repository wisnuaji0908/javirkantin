<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        @php
        $user = auth()->user();
        $userId = $user ? $user->id : null;
        $orders = App\Models\Order::where('user_id', $userId)->where('status', "0")->get();
    @endphp

    @if(auth()->user()->role=='member')
            <form action="/order/update" method="post">
                @csrf
                @method('PUT')
                {{-- <form action="/order/delete" method="get"> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-warning navbar-badge">{{ $orders->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <span class="dropdown-item dropdown-header">{{ $orders->count() }} items</span>
                        @foreach ($orders as $o)
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item">
                                <input type="checkbox" name="orders[]" value="{{ $o->id }}" class="order-checkbox" data-price="{{ $o->harga * $o->jumlah }}">
                                <i class="fas fa-envelope mr-2"></i> {{ $o->nama_barang }}<br>
                                harga: Rp.{{ $o->harga }} <br>
                                jumlah: {{ $o->jumlah }}
                            </div>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item">
                            <span>Total: Rp. <span id="total-price">0</span></span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <button type="submit" name="delete" onclick="return confirm('sure?')" value="delete" class="dropdown-item dropdown-footer">Batal Pesanan</button>
                    {{-- </form> --}}
                        <button type="submit" class="dropdown-item dropdown-footer">Pesan</button>
                    </div>
                </li>
            </form>
    @endif



        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Layar Penuh">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>

    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-primary" type="submit" value="Logout">Logout</button>
    </form>
</nav>
<!-- /.navbar -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let checkboxes = document.querySelectorAll('.order-checkbox');
        let totalPriceElement = document.getElementById('total-price');
        let cancelOrderBtn = document.getElementById('cancel-order-btn');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                calculateTotalPrice();
            });
        });

        cancelOrderBtn.addEventListener('click', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false;
            });
            calculateTotalPrice();
        });

        function calculateTotalPrice() {
            let total = 0;
            checkboxes.forEach(function (cb) {
                if (cb.checked) {
                    total += parseFloat(cb.getAttribute('data-price'));
                }
            });
            totalPriceElement.textContent = total;
        }
    });
</script>
