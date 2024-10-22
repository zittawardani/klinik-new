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
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#">Jadwal Dokter</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#">Ulasan</a></li>
                </ul>
                <a href="{{ route('login')}}" class="btn btn-outline-primary ms-3 fw-bold" style="background-color: white; color: #58A399">Login Admin</a>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <main>
        @yield('content')
    </main>

    @include('home.house')
    @includeWhen(isset($dokter), 'home.scedule')
    @include('home.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
