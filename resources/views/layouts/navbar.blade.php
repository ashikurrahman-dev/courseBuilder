<header class="bg-white shadow px-6 py-4 flex  items-center justify-between">
    <div></div>
    <div class="relative group">
        <button class="flex items-center gap-2 text-gray-700 hover:text-black focus:outline-none">
            <img src="https://i.pravatar.cc/40?img=5" alt="User" class="w-8 h-8 rounded-full">
            <span>John Doe</span>
            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded hidden group-hover:block z-10">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 text-red-600">Logout</a>
        </div>
    </div>
</header>