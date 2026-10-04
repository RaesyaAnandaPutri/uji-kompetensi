<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SMKN 4 Kota Bogor</title>

    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/9/9f/Logo_SMK_Negeri_4_Bogor.png">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        .auth-icon-circle {
            width: 90px;
            height: 90px;
            background-color: #eff6ff;
            color: #1d4ed8;
            border-radius: 50%;
        }
        .auth-input-group .input-group-text {
            background-color: #ffffff;
            border-right: none;
        }
        .auth-input-group .form-control {
            border-left: none;
        }
        .auth-input-group .form-control:focus {
            box-shadow: none;
            border-color: #86b7fe;
        }
        .btn-eye {
            border-left: none;
            background-color: #ffffff;
        }
        /* Matikan tombol "tampilkan password" bawaan browser (Edge/Chrome), supaya tidak dobel dengan tombol custom */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
        input::-webkit-credentials-auto-fill-button {
            visibility: hidden;
            display: none !important;
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <main class="container py-5" style="max-width: 640px;">

        <div class="mb-5">
            <h1 class="fw-bold display-5">MASUK</h1>
            <p class="text-muted">Masuk ke akun admin untuk mengelola konten website SMKN 4 Kota Bogor.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 mb-4">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success rounded-3 mb-4">{{ session('success') }}</div>
        @endif

        <div class="card border shadow-sm rounded-4 p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="auth-icon-circle d-inline-flex align-items-center justify-content-center mb-3">
                    <i class="fa-solid fa-lock fa-lg"></i>
                </div>
                <h3 class="fw-bold mb-1">Selamat Datang Kembali!</h3>
                <p class="text-muted mb-0">Silahkan masuk untuk melanjutkan</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text"><i class="fa-regular fa-envelope text-muted"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control py-2" placeholder="Masukkan email admin" required autofocus>
                    </div>
                </div>

                <!-- Bagian ini diubah class mb-2 menjadi mb-4 -->
                <div class="mb-4" x-data="{ show: false }">
                    <label class="form-label fw-semibold">Kata Sandi</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input :type="show ? 'text' : 'password'" name="password" class="form-control py-2" placeholder="Masukkan kata sandi" required>
                        <button type="button" class="btn btn-outline-secondary btn-eye" @click="show = !show" tabindex="-1">
                            <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold rounded-3 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk
                </button>
            </form>
        </div>

    </main>

    @include('partials.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>