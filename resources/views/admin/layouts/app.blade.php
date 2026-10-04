<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - SMKN 4 Kota Bogor</title>

    <!-- Google Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        /* Container & Layout */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling (w-64 = 16rem = 256px) */
        .admin-sidebar {
            width: 256px;
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem 1rem;
            flex-shrink: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        /* Logo Brand */
        .sidebar-brand-img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .brand-title {
            font-weight: 800;
            color: #1e3a8a;
            font-size: 0.75rem;
            letter-spacing: 0.025em;
            line-height: 1.2;
            display: block;
        }

        .brand-subtitle {
            font-weight: 700;
            color: #1e3a8a;
            font-size: 0.625rem;
            letter-spacing: 0.05em;
            display: block;
        }

        /* Nav Link Custom */
        .sidebar-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .sidebar-nav-link i {
            width: 1.25rem;
            text-align: center;
            font-size: 1rem;
        }

        .sidebar-nav-link:hover {
            background-color: #f8fafc;
            color: #0f172a;
        }

        /* State Active */
        .sidebar-nav-link.active {
            background-color: #0234BD !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(2, 52, 189, 0.2);
        }

        .sidebar-nav-link.active:hover {
            background-color: #0234BD !important;
            color: #ffffff !important;
        }

        /* Footer Text */
        .sidebar-footer-text {
            font-size: 0.625rem;
            color: #94a3b8;
            font-weight: 500;
        }

        /* Main Content Area */
        .admin-content {
            margin-left: 256px;
            flex-grow: 1;
            padding: 2rem 1rem;
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .admin-sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                margin-bottom: 1rem;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                border-right: none;
                border-bottom: 1px solid #f1f5f9;
            }

            .admin-content {
                margin-left: 0;
            }

            .admin-sidebar nav {
                flex-direction: row !important;
                gap: 0.5rem !important;
            }

            .admin-sidebar nav .sidebar-nav-link span {
                display: none;
            }
        }
    </style>

    @yield('styles')
</head>

<body>

    <div class="admin-layout">
        <!-- SIDEBAR (file terpisah) -->
        @include('admin.layouts.sidebar')

        <!-- AREA KONTEN UTAMA -->
        <main class="admin-content">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>