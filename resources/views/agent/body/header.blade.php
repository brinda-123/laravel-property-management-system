@php
$id = Auth::user()->id;
$agentId = App\Models\User::find($id);
$usermsg = App\Models\PropertyMessage::where('agent_id', $id)->get();
@endphp
 <nav class="navbar">
   <a href="#" class="sidebar-toggler">
     <i data-feather="menu"></i>
   </a>
   <div class="navbar-content">
     <form class="search-form">
       <div class="input-group">
         <div class="input-group-text">
           <i data-feather="search"></i>
         </div>
         <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
       </div>
     </form>
     <ul class="navbar-nav">

       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i data-feather="grid"></i>
         </a>
         <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
           <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
             <p class="mb-0 fw-bold">Web Apps</p>
           </div>
           <div class="row g-0 p-1">
             <div class="col-4 text-center">
               <a href="{{ route('agent.live.chat') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i data-feather="message-square" class="icon-lg mb-1"></i>
                 <p class="tx-12">Chat</p>
               </a>
             </div>
             <div class="col-4 text-center">
               <a href="{{ route('agent.property.message') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i data-feather="mail" class="icon-lg mb-1"></i>
                 <p class="tx-12">Email</p>
               </a>
             </div>
             <div class="col-4 text-center">
               <a href="{{ route('agent.profile') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i data-feather="instagram" class="icon-lg mb-1"></i>
                 <p class="tx-12">Profile</p>
               </a>
             </div>
           </div>
           <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
             <a href="javascript:;">View all</a>
           </div>
         </div>
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i data-feather="bell"></i>
           <div class="indicator">
             <div class="circle"></div>
           </div>
         </a>
         <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
           <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
             <p><span id="newMessageCount" class="badge bg-success fw-bolder ms-auto">{{ count($usermsg) }} New Message</span></p>
             <a href="javascript:;" id="clearAllMessages" class="text-muted">Clear all</a>
           </div>

           <div class="p-1">
             @foreach($usermsg as $msg)
             <div class="email-list-item">

               <a href=" " class="email-list-detail">
                 <div class="content">
                   <span class="from">{{ $msg['user']['name'] }}</span>
                   <p class="msg"> {{ $msg->message }} </p>
                 </div>
                 <span class="date">
                   <span class="icon"><i data-feather="paperclip"></i> </span>
                   {{ $msg->created_at->format('l M d') }}
                 </span>
               </a>
             </div>
             @endforeach
           </div>
           <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
             <a href="{{ route('agent.property.message') }}">View all</a>
           </div>
         </div>
       </li>

       @php

       $id = Auth::user()->id;
       $profileData = App\Models\User::find($id);

       @endphp


       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/agent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
         </a>
         <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
           <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
             <div class="mb-3">
               <img class="wd-80 ht-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/agent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="">
             </div>
             <div class="text-center">
               <p class="tx-16 fw-bolder">{{ $profileData->name }}</p>
               <p class="tx-12 text-muted">{{ $profileData->email }}</p>
             </div>
           </div>
           <ul class="list-unstyled p-1">
             <li class="dropdown-item py-2">
               <a href="{{ route('agent.profile') }}" class="text-body ms-0">
                 <i class="me-2 icon-md" data-feather="user"></i>
                 <span>Profile</span>
               </a>
             </li>
             <li class="dropdown-item py-2">
               <a href="{{ route('agent.change.password') }}" class="text-body ms-0">
                 <i class="me-2 icon-md" data-feather="edit"></i>
                 <span>Change Password</span>
               </a>
             </li>
             <li class="dropdown-item py-2">
               <a href="{{ route('agent.logout') }}" class="text-body ms-0">
                 <i class="me-2 icon-md" data-feather="repeat"></i>
                 <span>Switch User</span>
               </a>
             </li>
             <li class="dropdown-item py-2">
               <a href="{{ route('agent.logout') }}" class="text-body ms-0">
                 <i class="me-2 icon-md" data-feather="log-out"></i>
                 <span>Log Out</span>
               </a>
             </li>
           </ul>
         </div>
       </li>
     </ul>
   </div>
 </nav>

 <nav class="settings-sidebar">
   <div class="sidebar-body">
     <a href="#" class="settings-sidebar-toggler">
       <i data-feather="settings"></i>
     </a>
     <div class="theme-wrapper" id="themes">

       <h6 class="text-muted mb-2">Light Theme:</h6>
       <a class="theme-item" href="#" id="light-theme-toggle">
         <img src="{{ asset('backend/assets/images/screenshots/light.jpg') }}" alt="light theme">
       </a>
       <h6 class="text-muted mb-2">Dark Theme:</h6>
       <a class="theme-item" href="#" id="dark-theme-toggle">
         <img src="{{ asset('backend/assets/images/screenshots/dark.jpg') }}" alt="dark theme">
       </a>
     </div>
   </div>
 </nav>
 <script>
   function switchTheme(themeName) {
    href = "{{ asset('backend/assets/css') }}/" + themeName + ".css";
}

   const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

   if (currentTheme) {
     switchTheme(currentTheme);
   } else {
     switchTheme('demo1/style');
   }

   document.getElementById('dark-theme-toggle').addEventListener('click', function(event) {
     event.preventDefault();
     switchTheme('demo2/style');
     localStorage.setItem('theme', 'demo2/style');
   });

   document.getElementById('light-theme-toggle').addEventListener('click', function(event) {
     event.preventDefault();
     switchTheme('demo1/style');
     localStorage.setItem('theme', 'demo1/style');
   });
 </script>
 <script>
  document.addEventListener("DOMContentLoaded", function() {
    var newMessageCount = document.getElementById("newMessageCount");

    document.getElementById("clearAllMessages").addEventListener("click", function() {
      var messageItems = document.querySelectorAll(".email-list-item");
      messageItems.forEach(function(item) {
        item.parentNode.removeChild(item);
      });

      // Update the count to 0
      newMessageCount.textContent = "0 New Message";
    });
  });
</script>