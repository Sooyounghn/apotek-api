<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Apotek+')</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f7f8f5;
            color: #354b3c;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 255px;
            height: 100vh;
            background: #e5ede3;
            padding: 38px 24px;
            z-index: 100;
        }

        .brand {
            font-size: 25px;
            font-weight: 700;
            color: #385b42;
            margin-bottom: 65px;
        }

        .brand span {
            color: #78947a;
        }

        .menu-label {
            font-size: 11px;
            color: #879487;
            margin: 0 12px 20px;
            letter-spacing: 1.5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 16px;
            margin-bottom: 12px;
            border-radius: 10px;
            text-decoration: none;
            color: #637265;
            font-size: 14px;
            transition: .2s;
        }

        .menu a i {
            font-size: 18px;
        }

        .menu a:hover,
        .menu a.active {
            background: #d0dfce;
            color: #365b40;
        }

        .main {
            margin-left: 255px;
            padding: 42px 48px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 55px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e8ece5;
        }

        .topbar h2 {
            font-size: 24px;
            font-weight: 600;
            color: #354b3c;
        }

        .admin {
            color: #718071;
            font-size: 14px;
        }

        .content {
            width: 100%;
            min-height: 75vh;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 75px;
                padding: 28px 10px;
            }

            .brand {
                font-size: 0;
                margin-bottom: 55px;
            }

            .brand span {
                font-size: 22px;
            }

            .menu-label,
            .menu a span {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 15px 8px;
            }

            .main {
                margin-left: 75px;
                padding: 28px 20px;
            }

            .topbar {
                margin-bottom: 35px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="brand">Apotek<span>+</span></div>

        <div class="menu-label">MENU UTAMA</div>

        <nav class="menu">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>

            <a href="/pelanggan"
               class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Pelanggan</span>
            </a>

            <a href="/staf"
               class="{{ request()->routeIs('staf.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                <span>Data Staf</span>
            </a>

            <a href="/obat"
               class="{{ request()->routeIs('obat.*') ? 'active' : '' }}">
                <i class="bi bi-capsule"></i>
                <span>Data Obat</span>
            </a>

        </nav>

    </aside>

    <main class="main">

        <header class="topbar">
            <h2>@yield('page-title', 'Dashboard')</h2>

            <div class="admin">
                <i class="bi bi-person-circle"></i>
                Admin Apotek
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>

    </main>

</body>
</html>
