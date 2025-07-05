<div class="sidebar d-flex flex-column p-3">
    <h5 class="mb-4">Admin PPOB</h5>
    
    <div class="mb-2 text-white">
        <div>Saldo: Rp. {{ number_format($totalSaldo, 0, ',', '.') }}</strong></div>
    </div>

    <hr>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.harga.index') }}" class="{{ request()->routeIs('admin.harga.index') ? 'active' : '' }}">Atur Harga</a>

    <div class="logout mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline">Logout</button>
        </form>
    </div>    
    
</div>
