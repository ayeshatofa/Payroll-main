<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <nav class="bg-blue-600 shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="text-white text-xl font-bold">Automated Payroll System</a>

            <!-- Nav Links (Hidden on Mobile) -->
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-white hover:text-blue-300">Home</a>
                <a href="#" class="text-white hover:text-blue-300">About</a>
                <a href="#" class="text-white hover:text-blue-300">Services</a>
                <a href="#" class="text-white hover:text-blue-300">Contact</a>
            </div>

            <!-- Mobile Menu Button -->
            <button 
                id="menu-toggle" 
                class="block md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Mobile Nav Links -->
        <div id="mobile-menu" class="hidden md:hidden bg-blue-500">
            <a href="#" class="block text-white px-4 py-2 hover:bg-blue-400">Home</a>
            <a href="#" class="block text-white px-4 py-2 hover:bg-blue-400">About</a>
            <a href="#" class="block text-white px-4 py-2 hover:bg-blue-400">Services</a>
            <a href="#" class="block text-white px-4 py-2 hover:bg-blue-400">Contact</a>
        </div>
    </nav>
    @yield('content')

    <script>
        // Toggle mobile menu visibility
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    @yield('scripts')
</body>
</html>