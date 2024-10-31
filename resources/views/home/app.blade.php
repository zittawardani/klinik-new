<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik APP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #58A399;">
        <div class="container">
            <a class="navbar-brand fw-bold" style="color: white;" href="#">Klinik APP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#scedule">Jadwal Dokter</a></li>
                </ul>
                <!-- <a href="{{ route('login')}}" class="btn ms-3 fw-bold" style="background-color: white; color: #58A399">Login Admin</a> -->
                @if (Auth::check()) {{-- Check if user is logged in --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn ms-3 fw-bold" style="background-color: white; color: #58A399">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn ms-3 fw-bold" style="background-color: white; color: #58A399">Login</a>
            @endif
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <main>
        @yield('content')
    </main>

    @include('home.house')
    @includeWhen(isset($dokter), 'home.scedule')
    @include('home.feedback')
    @include('home.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
