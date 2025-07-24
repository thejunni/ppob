<div class="sidebar d-flex flex-column p-3" style="width: 250px; height: 100vh; background-color: green;">
    <h4 class="mb-4 text-white">Selamat Datang</h4>
    <h5 class="text-white">{{ $user->name }}</h5>
    <hr class="border-white">

    <a href="{{ route('customer.dashboard') }}" 
       class="btn mb-2 {{ request()->routeIs('customer.dashboard') ? 'custom-active fw-bold' : 'btn-success' }}">
       Dashboard
    </a>

    <a href="#" 
       class="btn mb-2 {{ request()->routeIs('#') ? 'custom-active fw-bold' : 'btn-success' }}">
       History
    </a>

    <div class="logout mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-50">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</div>
