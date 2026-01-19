<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
</head>

<body>
    <!-- Global Loading Overlay -->
    <div id="global-loading" class="loading-overlay d-none">
        <div class="loading-spinner" id="loading-indicator">
            <div class="lds-hourglass"></div>
        </div>
    </div>

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
                            <li class="nav-item {{ request()->is('admin/settings') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings') }}" class="nav-link">
                                    <i class='bx bxs-circle'></i>
                                    <span>Настройка системы</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('admin/category*') ? 'active' : '' }}">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link">
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

    @if ($errors->any())
        <script>
            window.addEventListener('load', () => {
                document.getElementById('global-loading')?.classList.add('d-none');
            });
        </script>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            const overlay = document.getElementById('global-loading');

            // 🔒 ВСЕГДА скрываем loader при любом рендере страницы
            if (overlay) {
                overlay.classList.add('d-none');
            }

            // ✅ Показываем loader ТОЛЬКО если страница реально уходит
            window.addEventListener('beforeunload', function() {
                if (overlay) {
                    overlay.classList.remove('d-none');
                }
            });
        })();

        // Sidebar toggle
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.querySelector('.sidebar-toggle');
            const mainContent = document.querySelector('.main-content');

            toggleBtn?.addEventListener('click', () => {
                sidebar?.classList.toggle('collapsed');
                mainContent?.classList.toggle('expanded');
            });
        });

        // Submenu toggle
        function toggleSubmenu(event, element) {
            event.preventDefault();
            const parent = element.closest('.nav-item');
            parent?.classList.toggle('open');
        }
    </script>

    @stack('scripts')
</body>

</html>
