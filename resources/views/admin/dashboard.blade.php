<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }} - Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Alert -->
            @include('components.alert')

            <!-- Header -->
            <div class="mb-6">
                @php $user = Auth::user(); @endphp
                <h1 class="text-3xl font-bold mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Welcome, <strong>{{ $user->name }}</strong> | {{ $user->email }}</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h2 class="text-sm font-medium text-gray-500">Total Complaints</h2>
                    <p class="text-2xl font-bold text-blue-600">{{ $totalComplaint }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h2 class="text-sm font-medium text-gray-500">Pending</h2>
                    <p class="text-2xl font-bold text-yellow-500">{{ $pendingComplaint }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h2 class="text-sm font-medium text-gray-500">In Progress</h2>
                    <p class="text-2xl font-bold text-blue-400">{{ $inProgressComplaint }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h2 class="text-sm font-medium text-gray-500">Resolved</h2>
                    <p class="text-2xl font-bold text-green-600">{{ $resolvedComplaint }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h2 class="text-sm font-medium text-gray-500">Rejected</h2>
                    <p class="text-2xl font-bold text-red-500">{{ $rejectedComplaint }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h2 class="text-sm font-medium text-gray-500">Canceled</h2>
                    <p class="text-2xl font-bold text-gray-500">{{ $canceledComplaint }}</p>
                </div>
            </div>

            <!-- Footer info (optional) -->
            <p class="text-sm text-gray-400">File: <code>resources/views/admin/dashboard.blade.php</code></p>
        </main>
    </div>

</body>
</html>
