<div class="sidebar d-flex flex-column p-3">
    <h4 class="mb-4">Selamat Datang</h4>
    <h5>{{ $user->name }}</h5>
    {{-- <div class="mb-2 text-white">
        <div>Saldo: <strong>Rp {{ number_format(7739862, 0, ',', '.') }}</strong></div>
    </div> --}}

    <hr>

    <a href="{{ route('customer.dashboard') }}" class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">Dashboard</a>
    <div class="logout mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline">Logout</button>
        </form>
    </div>    
    
</div>
