<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Navbar</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-white text-black shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-black font-bold text-2xl">Polresta Padang</a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="#home"
                        class="text-black hover:text-gray-200 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-home w-6 h-6"></i>
                        <span>Home</span>
                    </a>

                    <a href="#about"
                        class="text-black hover:text-gray-200 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-info-circle w-6 h-6"></i>
                        <span>About</span>
                    </a>

                    <a href="#team"
                        class="text-black hover:text-gray-200 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-users w-6 h-6"></i>
                        <span>Team</span>
                    </a>

                    <a href="#services"
                        class="text-black hover:text-gray-200 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-cogs w-6 h-6"></i>
                        <span>Services</span>
                    </a>

                    <a href="#location"
                        class="text-black hover:text-gray-200 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-map-marker-alt w-6 h-6"></i>
                        <span>Location</span>
                    </a>

                    <a href="/register"
                        class="text-black hover:text-gray-200 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-user-plus w-6 h-6"></i>
                        <span>Register</span>
                    </a>
                </div>
                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden ">
            <a href="/" class="block px-4 py-2 text-black hover:bg-blue-700">Home</a>
            <a href="#about" class="block px-4 py-2 text-black hover:bg-blue-700">About</a>
            <a href="#team" class="block px-4 py-2 text-black hover:bg-blue-700">Team</a>
            <a href="#services" class="block px-4 py-2 text-black hover:bg-blue-700">Srvices</a>
            <a href="#location" class="block px-4 py-2 text-black hover:bg-blue-700">Location</a>
            <a href="/register" class="block px-4 py-2 text-black hover:bg-blue-700">Register</a>
        </div>
    </nav>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>
