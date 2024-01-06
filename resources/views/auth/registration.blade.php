<form id="registrForm" action="{{ route('registr') }}" method="POST">
    <div id="registrError"
        class="hidden p-4 my-5 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"role="alert">
    </div>




    <div class="mt-4">
        <label> Profile Picture</label>
        <input
            class="rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
            id="registrProfile" aria-describedby="user_avatar_help" name="profile" type="file">
        <div id="registrProfileAlert"class=" text-sm text-red-800"></div>

    </div>




    <div class="mt-4">
        <label> Name</label>
        <input
            class="py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
            id="registrName" type="text" name="name" placeholder="Your Name" />
        <div id="registrNameAlert"class=" text-sm text-red-800"></div>
    </div>

    <div class="mt-4">
        <label> Email</label>
        <input
            class="py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
            id="registrEmail" type="email" name="email" placeholder="Your email address" />
        <div id="registrEmailAlert"class=" text-sm text-red-800"></div>

    </div>

    <div class="mt-4">
        <label> Password</label>
        <input
            class=" py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
            id="registrPassword" type="password" name="password" placeholder="Your password"
            autocomplete="new-password" />
        <div id="registrPasswordAlert"class=" text-sm text-red-800"></div>
    </div>



    <div class="mt-4">
        <label>Confirm password</label>
        <input
            class="py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark:focus:border-gray-300 hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
            id="registrPasswordConfirmation" type="password" name="password_confirmation"
            placeholder="Confirm your password" autocomplete="new-password" />
        <div id="registrPasswordConfirmationAlert"class=" text-sm text-red-800"></div>
    </div>

    <div class="mt-4 flex items-center justify-end">
        <button type="submit"
            class="ml-4 inline-flex items-center rounded-lg bg-gray-200 p-2 text-xs font-bold text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-800">Sign
            in</button>
    </div>
</form>