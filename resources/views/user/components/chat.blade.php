
@php
$userId = Auth::user()->id;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Set TailwindCss -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="/assets/chat.js"></script>
</head>
<body>

<!-- Set Alert biar muncul kalo error -->
@include('components.alert')



<section class="flex flex-col min-h-screen">

<div>

</div>


@if ($chats->isEmpty())
<div class="h-screen w-full flex items-center justify-center">
    <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div>
        <span class="font-medium">Pesan hanya dapat di mulai oleh Admin,</span> Belum ada Pesan saat ini.
    </div>
    </div>
</div>
@else


    <div class="flex flex-1">
        <!-- Sidebar -->
        <div class="bg-white w-1/3 border-r shadow-lg">
            <!-- Header Sidebar -->
            <div class="bg-green-500 text-white p-4 flex justify-start items-center space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="py-1 pl-1 pr-1.5 bg-white text-green-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <h1 class="text-lg font-semibold">Chats</h1>
            </div>

            <!-- Chat List -->
            <div class="p-4 space-y-4 overflow-y-auto h-[calc(100%-64px)]">
                
                @foreach ($chats as $chat)
                    
                    <button id="chat-button-{{ $chat->id }}" onclick="updateChatMessages({{ json_encode($chat->message) }}, '{{ $chat->toUser->name }}', '{{ $chat->id }}', '{{ $chat->to }}', '{{ $chat->status }}')" class="flex items-center justify-between space-x-4 cursor-pointer hover:bg-gray-100 p-2 rounded-lg w-full">
                        <div class="flex-1 text-left">
                            <h2 class="font-semibold">{{ $chat->toUser->name }}</h2>
                            <p class="text-sm text-gray-500 truncate">ketuk untuk melihat pesan</p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $chat->updated_at }}</span>
                    </button>

                    @if (request('chatId') && request('chatId') == $chat->id)
                        <script>
                            // Tunggu sampai DOM selesai dimuat
                            document.addEventListener('DOMContentLoaded', function() {
                                // Memastikan bahwa tombol dengan ID tersebut ada di DOM
                                const chatButton = document.getElementById('chat-button-{{ $chat->id }}');
                                if (chatButton) {
                                    // Klik tombol tersebut
                                    chatButton.click();
                                }
                            });
                        </script>
                    @endif

                @endforeach
                
                <!-- More contacts here -->

                <p class="text-sm text-gray-500">Hanya admin yang dapat memulai chat</p>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 bg-white flex flex-col">
            <!-- Header Chat -->
            <div class="bg-green-500 text-white p-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div id="receiver_initial" class="bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center text-gray-500">
                        A
                    </div>
                    <h1 id="receiver_name" class="font-semibold">Alice</h1>
                </div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="bg-white text-green-500 p-1 rounded-lg text-sm hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>
                </button>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Kembali ke Dashboard</a>
                    </li>
                    </ul>
                </div>
            </div>

            <!-- Chat Messages -->
            <div id="chatMessage" class="flex-1 p-4 space-y-4 overflow-y-auto bg-gray-50">

                <!-- Message Sent -->
                <div class="flex justify-end">
                    <div class="bg-green-500 text-white px-4 py-2 rounded-lg max-w-xs">
                        Hai ini adalah halaman chat dengan User, Hanya admin yang dapat memulai percakapan dan mengakhiri percakapan.
                    </div>
                </div>
                <!-- Message Received -->
                <div class="flex justify-start">
                    <div class="bg-gray-200 px-4 py-2 rounded-lg max-w-xs">
                        Anda dapat memulai chat dengan user pda halaman detail complaint mereka
                    </div>
                </div>

            </div>

            <!-- Input Chat -->
            <form id="formChat" class="p-4 border-t flex items-center" action="{{ route('user.send.chat') }}" method="POST">
                @csrf
                <input id="chat_id" type="hidden" name="chatId" required>
                <input id="chat_message"
                    type="text" 
                    name="message" 
                    placeholder="Type a message..." 
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300"
                    required
                />
                <button 
                    type="submit" 
                    class="ml-2 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Send
                </button>
            </form>
        </div>
    </div>


    
@endif

</section>

</body>
</html>