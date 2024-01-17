
                <div class="flex w-full flex-wrap items-center justify-between px-1 py-4">
                    <div class="w-full rounded-md" aria-label="breadcrumb">
                        <ol class="list-reset ml-2 flex">

        <li>
        <a href="{{ route('index') }}">
          <span class=" text-neutral-500 dark:text-neutral-200"
            >{{__("Control Panel")}}</span
          ></a>
        </li>
        <li>
          <span class="mx-2 text-neutral-500 dark:text-neutral-200"
            >/</span
          >
        </li>

                            @yield('content-header')
                        </ol>
                    </div>
                </div>
    