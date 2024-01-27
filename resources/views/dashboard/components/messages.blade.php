 @if (isset($unreadMessages) && $unreadMessages->count() > 0)
     @foreach ($unreadMessages as $message)
         <li class="notification-message">
             <a href="activities.html">
                 <div class="media d-flex">
                     {{-- <span class="avatar flex-shrink-0">
                     <img alt=""
                         src="{{ asset('dashboard/assets/img/profiles/avatar-02.jpg') }}">
                 </span> --}}
                     <div class="media-body flex-grow-1 ">
                         <p class="noti-details">
                             <span class="noti-title">

                                 <div class="flex flex-col items-start">
                                     {{ $message->name }}
                             </span>
                             <b>{{ $message->email }}</b>
                             <span class="noti-title">
                                 {{ substr($message->message, 0, 50) }}
                             </span>
                     </div>
                     </p>
                     <p class="noti-time"><span
                             class="notification-time">{{ $message->created_at->diffForHumans() }}</span>
                     </p>
                 </div>
                 </div>
             </a>
         </li>
     @endforeach
 @else
     <div class="h-[290px] w-[350px] flex flex-col justify-center items-center">
         <img src="{{ asset('dashboard/assets/img/icons/empty_inbox.svg') }}" alt="img">
         <h1>There are no unread messages</h1>
     </div>
 @endif
