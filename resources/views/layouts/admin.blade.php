<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindSpace Edu — Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6C3FC5',
                        secondary: '#F5A623',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">

<!-- Mobile Top Bar -->
<div class="lg:hidden flex items-center justify-between bg-primary text-white px-4 py-3">
    <h1 class="text-lg font-bold">MindSpace Edu</h1>
    <button onclick="document.getElementById('sidebar').classList.toggle('hidden')" class="text-white text-2xl">☰</button>
</div>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar" class="hidden lg:flex w-64 bg-primary text-white flex-col shadow-lg fixed lg:static top-0 left-0 h-full z-50 lg:z-auto">
        <div class="p-6 border-b border-purple-700 hidden lg:block">
            <h1 class="text-xl font-bold">MindSpace Edu</h1>
            <p class="text-xs text-purple-300 mt-1">Admin Dashboard</p>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            <a href="/dashboard" onclick="closeSidebar()" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-purple-700 transition {{ request()->is('dashboard') ? 'bg-purple-700' : '' }}">
                <span>📊</span> Dashboard
            </a>
            <a href="/screenings" onclick="closeSidebar()" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-purple-700 transition {{ request()->is('screenings*') ? 'bg-purple-700' : '' }}">
                <span>🧠</span> Screening
            </a>
            <a href="/appointments" onclick="closeSidebar()" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-purple-700 transition {{ request()->is('appointments*') ? 'bg-purple-700' : '' }}">
                <span>📅</span> Appointment
            </a>
            <a href="/schools" onclick="closeSidebar()" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-purple-700 transition {{ request()->is('schools*') ? 'bg-purple-700' : '' }}">
                <span>🏫</span> Sekolah
            </a>
        </nav>
        <div class="p-4 border-t border-purple-700">
            <p class="text-xs text-purple-300 mb-2">{{ auth()->user()->name }}</p>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay mobile -->
    <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" onclick="closeSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 min-w-0">
        <header class="bg-white shadow px-4 lg:px-8 py-4 flex items-center justify-between">
            <h2 class="text-lg lg:text-xl font-semibold text-gray-700">@yield('title')</h2>
            <span class="text-sm text-gray-400 hidden sm:block">{{ now()->format('d M Y') }}</span>
        </header>
        <div class="p-4 lg:p-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</div>

<script>
    function closeSidebar() {
        document.getElementById('sidebar').classList.add('hidden');
        document.getElementById('overlay').classList.add('hidden');
    }

    document.querySelector('button[onclick*="sidebar"]')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        if (!sidebar.classList.contains('hidden')) {
            overlay.classList.remove('hidden');
        } else {
            overlay.classList.add('hidden');
        }
    });
</script>

</body>
</html>