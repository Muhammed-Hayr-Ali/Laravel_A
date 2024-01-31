 <div class="absolute right-3 top-0 bg-[#ffffff1c] rounded-b-lg p-3  flex flex-row  space-x-3 text-white text-xs">

     @if (Auth::check())
         @if (Auth::user()->role == 'Administrator')
             <a href="{{ route('/index') }}" class="hover:text-primaryColor-500">{{ __('webSite.' . 'Dashboard') }}</a>
         @endif
     @else
         <a href="{{ route('signin.index') }}"
             class="hover:text-primaryColor-500">{{ __('webSite.' . 'Get Started') }}</a>
     @endif


     <div class="flex flex-row space-x-1 ">
         <a class="hover:underline-offset-0 hover:text-primaryColor-500" href="language/ar">AR</a>
         <div>/</div>
         <a class="hover:underline-offset-0 hover:text-primaryColor-500" href="language/en">EN</a>
         <div>/</div>
         <a class="hover:underline-offset-0 hover:text-primaryColor-500" href="language/tr">TR</a>
         <div>/</div>
         <a class="hover:underline-offset-0 hover:text-primaryColor-500" href="language/ku">KU</a>

     </div>
 </div>
