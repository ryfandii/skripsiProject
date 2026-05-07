{{-- ================================================================
FILE: resources/views/layouts/app.blade.php
================================================================ --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMAN 1</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            background: #f4f6fa;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Geser konten agar tidak tertimpa sidebar (240px) dan topbar (60px) */
        #main-content {
            margin-left: 240px;
            padding: 72px 24px 24px;
            min-height: 100vh;
            background: #f4f6fa;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            #main-content {
                margin-left: 0;
                padding: 72px 16px 20px;
            }

            .custom-sidebar {
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }

            .custom-sidebar.open {
                transform: translateX(0);
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR → resources/views/components/sidebar.blade.php --}}
    @include('components.sidebar')

    {{-- TOPBAR → resources/views/components/topbar.blade.php --}}
    @include('components.topbar')

    {{-- KONTEN UTAMA --}}
    <div id="main-content">
        @yield('content')
    </div>

    <script>
        const sidebarToggleBtn = document.getElementById('sidebarToggleTop');
        const sidebar = document.querySelector('.custom-sidebar');

        if (sidebarToggleBtn && sidebar) {
            sidebarToggleBtn.addEventListener('click', function () {
                sidebar.classList.toggle('open');
            });

            document.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !sidebarToggleBtn.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });
        }
    </script>

    @stack('scripts')
</body>

</html>