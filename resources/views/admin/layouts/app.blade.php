<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sneat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
</head>

<body>
    <div class="layout-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-logo">
                    <img src="{{ asset('assets/admin/img/logojeywa.png') }}" alt="Jeywa studio">
                </a>
                <button class="sidebar-toggle">
                    <i class='bx bx-chevron-left'></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li class="nav-item has-submenu open">
                        <a href="#" class="nav-link" onclick="toggleSubmenu(event, this)">
                            <i class='bx bx-cog'></i>
                            <span>Настройка скрипта</span>
                            <i class='bx bx-chevron-down submenu-arrow'></i>
                        </a>
                        <ul class="submenu">
                            <li class="nav-item active">
                                <a href="" class="nav-link">
                                    <i class='bx bxs-circle'></i>
                                    <span>Настройка системы</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class='bx bxs-circle'></i>
                                    <span>Категории</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <div class="search-box">
                        <i class='bx bx-search'></i>
                        <span>Search [CTRL + K]</span>
                    </div>
                </div>
                <div class="header-right">
                    <button class="header-btn">
                        <i class='bx bx-globe'></i>
                    </button>
                    <button class="header-btn">
                        <i class='bx bx-sun'></i>
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="header-btn">
                            <i class='bx bx-log-out'></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.layout-wrapper').classList.toggle('sidebar-collapsed');
        });

        // Toggle submenu
        function toggleSubmenu(event, element) {
            event.preventDefault();
            const parent = element.closest('.nav-item');
            parent.classList.toggle('open');
        }
    </script>
    
    @stack('scripts')
</body>

</html>
