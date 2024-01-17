<div id="registr">
    <div class="relative w-1/3 bg-white shadow-xl rounded-xl px-8 pt-6 pb-8 mb-4">
        <button id="closeRegister"><svg class="absolute top-1 right-1 h-4 w-4 fill-black hover:fill-red-500"
                viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z" />
            </svg></button>


        <form id="registrForm" action="{{ route('registr.store') }}" method="POST">
            <div id="registrError"
                class="hidden p-4 my-5 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"role="alert">
            </div>
            <div class="mt-4">
                <label> Profile Picture</label>
                <input
                    class="rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
                    id="registrProfile" aria-describedby="user_avatar_help" name="profile" type="file">
            </div>
            <div id="registrProfileAlert"class=" text-sm text-red-800"></div>
            <div class="mt-4">
                <label> Name</label>
                <input
                    class="py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
                    id="registrName" type="text" name="name" placeholder="Your Name" />
            </div>
            <div id="registrNameAlert"class=" text-sm text-red-800"></div>
            <div class="mt-4">
                <label> Email</label>
                <input
                    class="py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
                    id="registrEmail" type="email" name="email" placeholder="Your email address" />
            </div>
            <div id="registrEmailAlert"class=" text-sm text-red-800"></div>
            <div class="mt-4 relative">
                <label> Password</label>
                <input
                    class=" py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark: focus:border-gray-300  hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
                    id="registrPassword" type="password" name="password" placeholder="Your password"
                    autocomplete="new-password" />
                <button type="submit" id="registrShowPassword"
                    style="display: block; position: absolute;top: 55%; right: 8px;"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21.335 11.4069L22.2682 11.0474L21.335 11.4069ZM21.335 12.5932L20.4018 12.2337L21.335 12.5932ZM2.66492 11.4068L1.73175 11.0474L2.66492 11.4068ZM2.66492 12.5932L1.73175 12.9526L2.66492 12.5932ZM3.5981 11.7663C4.89784 8.39171 8.17084 6 12 6V4C7.31641 4 3.31889 6.92667 1.73175 11.0474L3.5981 11.7663ZM12 6C15.8291 6 19.1021 8.39172 20.4018 11.7663L22.2682 11.0474C20.681 6.92668 16.6835 4 12 4V6ZM20.4018 12.2337C19.1021 15.6083 15.8291 18 12 18V20C16.6835 20 20.681 17.0733 22.2682 12.9526L20.4018 12.2337ZM12 18C8.17084 18 4.89784 15.6083 3.5981 12.2337L1.73175 12.9526C3.31889 17.0733 7.31641 20 12 20V18ZM20.4018 11.7663C20.4597 11.9165 20.4597 12.0835 20.4018 12.2337L22.2682 12.9526C22.5043 12.3396 22.5043 11.6604 22.2682 11.0474L20.4018 11.7663ZM1.73175 11.0474C1.49567 11.6604 1.49567 12.3396 1.73175 12.9526L3.5981 12.2337C3.54022 12.0835 3.54022 11.9165 3.5981 11.7663L1.73175 11.0474Z"
                            fill="#000000" />
                        <circle cx="12" cy="12" r="3" stroke="#000000" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg></button>
                <button type="submit" id="registrHidePassword"
                    style="display: none; position: absolute;top: 55%; right: 8px;"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4L20 20" stroke="#993333" stroke-width="2" stroke-linecap="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.22308 5.63732C4.19212 6.89322 2.60069 8.79137 1.73175 11.0474C1.49567 11.6604 1.49567 12.3396 1.73175 12.9526C3.31889 17.0733 7.31641 20 12 20C14.422 20 16.6606 19.2173 18.4773 17.8915L17.042 16.4562C15.6033 17.4309 13.8678 18 12 18C8.17084 18 4.89784 15.6083 3.5981 12.2337C3.54022 12.0835 3.54022 11.9165 3.5981 11.7663C4.36731 9.76914 5.82766 8.11625 7.6854 7.09964L6.22308 5.63732ZM9.47955 8.89379C8.5768 9.6272 7.99997 10.7462 7.99997 12C7.99997 14.2091 9.79083 16 12 16C13.2537 16 14.3728 15.4232 15.1062 14.5204L13.6766 13.0908C13.3197 13.6382 12.7021 14 12 14C10.8954 14 9.99997 13.1046 9.99997 12C9.99997 11.2979 10.3618 10.6802 10.9091 10.3234L9.47955 8.89379ZM15.9627 12.5485L11.4515 8.03729C11.6308 8.0127 11.8139 8 12 8C14.2091 8 16 9.79086 16 12C16 12.1861 15.9873 12.3692 15.9627 12.5485ZM18.5678 15.1536C19.3538 14.3151 19.9812 13.3259 20.4018 12.2337C20.4597 12.0835 20.4597 11.9165 20.4018 11.7663C19.1021 8.39172 15.8291 6 12 6C11.2082 6 10.4402 6.10226 9.70851 6.29433L8.11855 4.70437C9.32541 4.24913 10.6335 4 12 4C16.6835 4 20.681 6.92668 22.2682 11.0474C22.5043 11.6604 22.5043 12.3396 22.2682 12.9526C21.7464 14.3074 20.964 15.5331 19.9824 16.5682L18.5678 15.1536Z"
                            fill="#993333" />
                    </svg></button>
            </div>
            <div id="registrPasswordAlert"class=" text-sm text-red-800"></div>
            <div class="mt-4">
                <label>Confirm password</label>
                <input
                    class="py-2 rounded-md dark:text-gray-400 bg-gray-100 dark:bg-gray-900 border-transparent dark:border-gray-700 dark:hover:border-gray-700 dark:focus:border-gray-300 hover:border-gray-300 hover:focus:border-gray-300 focus:ring-0 text-sm mt-1 block w-full"
                    id="registrPasswordConfirmation" type="password" name="password_confirmation"
                    placeholder="Confirm your password" autocomplete="new-password" />
            </div>
            <div id="registrPasswordConfirmationAlert"class=" text-sm text-red-800"></div>

            <div class="mt-4 flex items-center justify-end">
                <button type="submit"
                    class="ml-4 inline-flex items-center rounded-lg bg-gray-200 p-2 text-xs font-bold text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-800">Registe</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('assets/general/js/guest.js') }}"></script>
<script src="{{ asset('assets/general/js/registr.js') }}"></script>
