<form id="loginForm" action="{{ route('login') }}" method="POST">
    @csrf
    <div id="loginError"
        class="hidden p-4 my-5 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"role="alert">
    </div>
    <div class="mt-4">
        <label> Email</label>
        <input
            class="py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
            id="loginEmail" type="text" name="email" placeholder="Your email address" />
        <div id="loginEmailAlert"class=" text-sm text-red-800"></div>
    </div>

    <div class="mt-4">
        <label> Password</label>
        <input
            class=" py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
            id="loginPassword" type="password" name="password" placeholder="Your password"
            autocomplete="new-password" />
        <div id="loginPasswordAlert"class=" text-sm text-red-800"></div>
    </div>
    <div class="mt-4 flex items-center justify-end">
        <button type="submit"
            class="ml-4 inline-flex items-center rounded-lg bg-gray-200 p-2 text-xs font-bold text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-800">Sign
            in</button>
    </div>
</form>