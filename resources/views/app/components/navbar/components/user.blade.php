@auth
    <div class="w-10 h-10">
    <button type="button" class="w-10 h-10 flex text-sm duration-200  bg-transparent hover:bg-white p-0.5 rounded-full md:me-0 "
        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" >
        <span class="sr-only">Open user menu</span>
        @if (Auth::user()->profile)
            <img class="profile " src="{{ Auth::user()->profile }}" alt="user photo">
        @else
            <img class="profile"
                src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}&format=svg"
                alt="user photo">
        @endif
    </button>
</div>


    
    <!-- Dropdown menu -->
    
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
        id="user-dropdown">
        <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                    out</a>
            </li>
        </ul>
    </div>
@endauth