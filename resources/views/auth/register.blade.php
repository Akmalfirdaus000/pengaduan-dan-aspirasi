<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Include TailwindCss -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="/logo.png">
</head>


<body
    class="flex items-center justify-center min-h-screen bg-gradient-to-r from-red-600 via-yellow-500 to-black relative">
    <!-- Alert Component for Error Messages -->
    @include('components.alert')

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full relative z-10">
        <h1 class="text-4xl font-bold text-center text-red-600 mb-6">Buat Akun Baru</h1>
        <p class="text-center text-gray-600 mb-8">Silakan daftar untuk mendapatkan akses</p>

        <form action="{{ route('register.action') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" name="name" type="text" placeholder="Masukkan nama lengkap Anda"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600"
                    required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input id="email" name="email" type="email" placeholder="Masukkan email Anda"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600"
                    required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input id="password" name="password" type="password" placeholder="Masukkan kata sandi Anda"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600"
                    required>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata
                    Sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    placeholder="Ulangi kata sandi Anda"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600"
                    required>
            </div>

            <button type="submit"
                class="w-full py-3 bg-red-600 text-white font-bold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition duration-150 ease-in-out">Daftar</button>
        </form>

        <p class="text-center text-gray-600 mt-6">Sudah punya akun? <a href="login"
                class="text-red-600 hover:text-red-800 font-medium">Masuk</a></p>

                <div class="w-full flex justify-center items-center mt-3">
            <div class="flex-1 border-b border-gray-500"></div>
            <div class="mx-2 text-gray-600">atau</div>
            <div class="flex-1 border-b border-gray-500"></div>
        </div>

        <div class="flex flex-col">
        <a href="{{ route('redirect', ['driver' => 'google']) }}" class="mt-4 w-full flex justify-center">  
            <button
                aria-label="Sign in with Google"
                class="flex items-center gap-3 bg-google-button-blue rounded-full p-0.5 pr-4 transition-colors duration-300 hover:bg-google-button-blue-hover"
                >
                <div class="flex items-center justify-center bg-white w-9 h-9 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                    <title>Sign in with Google</title>
                    <desc>Google G Logo</desc>
                    <path
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        class="fill-google-logo-blue"
                    ></path>
                    <path
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        class="fill-google-logo-green"
                    ></path>
                    <path
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                        class="fill-google-logo-yellow"
                    ></path>
                    <path
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                        class="fill-google-logo-red"
                    ></path>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-white tracking-wider">Register dengan Google</span>
            </button>
        </a>

        <a href="{{ route('redirect', ['driver' => 'facebook']) }}" class="mt-4 w-full flex justify-center">  
            <button
                aria-label="Sign in with Google"
                class="flex items-center gap-3 bg-blue-100 rounded-full p-0.5 pr-4 transition-colors duration-300 hover:bg-google-button-blue-hover group border border-blue-600"
                >
                <div class="flex items-center justify-center bg-white w-9 h-9 rounded-full">

                    <svg fill="currentColor" class="w-9 h-9 text-blue-600" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 2.03998C6.5 2.03998 2 6.52998 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.84998C10.44 7.33998 11.93 5.95998 14.22 5.95998C15.31 5.95998 16.45 6.14998 16.45 6.14998V8.61998H15.19C13.95 8.61998 13.56 9.38998 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96C15.9164 21.5878 18.0622 20.3855 19.6099 18.57C21.1576 16.7546 22.0054 14.4456 22 12.06C22 6.52998 17.5 2.03998 12 2.03998Z"></path> </g></svg>
                </div>
                <span class="text-sm font-semibold text-blue-600 tracking-wider group-hover:text-white">Register dengan Facebook</span>
            </button>
        </a>

    </div>

    </div>
</body>

</html>
