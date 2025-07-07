  <aside class="w-64 bg-white shadow-md p-4 hidden md:block">
            <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('complaint.admin') }}" class="block px-3 py-2 rounded hover:bg-gray-100">📋 Complaint List</a>
                </li>
                <li>
                    <a href="{{ route('category.list') }}" class="block px-3 py-2 rounded hover:bg-gray-100">📂 Category List</a>
                </li>
                <li>
                    <a href="{{ route('chat.list') }}" class="block px-3 py-2 rounded hover:bg-gray-100">💬 Chat</a>
                </li>
                <li>
                    <a href="{{ route('rekap.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">💬 rekap</a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" class="block px-3 py-2 rounded hover:bg-gray-100">👤 Profile</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="block px-3 py-2 rounded text-red-600 hover:bg-red-100">🚪 Logout</a>
                </li>
                <li>
                    <a href="{{ url()->previous() }}" class="block px-3 py-2 rounded hover:bg-gray-100">🔙 Kembali</a>
                </li>
            </ul>
        </aside>
