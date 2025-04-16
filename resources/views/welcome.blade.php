
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Automated Payroll System</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#4F46E5",
                        secondary: "#6366F1"
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-primary dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-building mr-2" viewBox="0 0 16 16">
                    <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z"/>
                    <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z"/>
                </svg>
                Automated Payroll System</a>
            <div class="hidden md:flex space-x-4">
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary">Admin Dashboard</a>
                        @else
                            <a href="{{ route('profile.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary">User Dashboard</a>
                        @endif
                        <a href="{{ route('logout') }}" class="text-red-500 hover:text-red-700"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-gray-700 dark:text-gray-300 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 shadow-md px-6 py-4">
            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.index') }}" class="block text-gray-700 dark:text-gray-300 py-2">Admin Dashboard</a>
                    @else
                        <a href="{{ route('profile.index') }}" class="block text-gray-700 dark:text-gray-300 py-2">User Dashboard</a>
                    @endif
                    <a href="{{ route('logout') }}" class="block text-red-500 py-2"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-700 dark:text-gray-300 py-2">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block text-gray-700 dark:text-gray-300 py-2">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="flex items-center justify-center h-screen bg-gradient-to-br from-primary to-secondary dark:from-gray-800 dark:to-gray-900 text-white">
        <div class="text-center px-6">
            <h1 class="text-5xl font-extrabold mb-4 animate-fade-in">Effortless Payroll Management</h1>
            <p class="text-lg text-gray-200 mb-6 animate-slide-up">Automate employee salary processing with accuracy and ease.</p>
            @auth
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.index') : route('profile.index') }}" 
                   class="bg-white text-primary font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 hover:bg-gray-100 animate-bounce">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="bg-white text-primary font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 hover:bg-gray-100 animate-bounce">
                    Get Started
                </a>
            @endauth
        </div>
    </header>

    <script>
        // Mobile Menu Toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>
</html>

