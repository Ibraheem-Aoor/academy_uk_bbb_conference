   <!-- sidebar-wrapper -->
   <nav id="sidebar" class="sidebar-wrapper sidebar-dark">
       <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
           <div class="sidebar-brand">
               <a href="routes('admin.dashboard')">
                   <img loading="lazy" src="{{ asset('assets/common/logo.png') }}" height="24">

               </a>
           </div>

           <ul class="sidebar-menu">
               <li class="">
                   <a href="{{ route('user.home') }}"><i
                           class="ti ti-home me-2"></i>{{ __('general.dashboard') }}</a>
               </li>
               <li class="">
                   <a href="{{ route('user.dashboard') }}"><i
                           class="ti ti-home me-2"></i>{{ __('general.overview') }}</a>
               </li>
               <li class="">
                   <a href="{{ route('user.meeting.index') }}"><i
                           class="ti ti-camera me-2"></i>{{ __('general.meetings') }}</a>
               </li>
                <li class="">
                   <a href="{{ route('user.recording.index') }}"><i
                           class="ti ti-video me-2"></i>{{ __('general.recordings') }}</a>
               </li>
                <li class="">
                   <a href="{{ route('user.plan.index') }}"><i
                           class="ti ti-cash me-2"></i>{{ __('general.subscriptions') }}</a>
               </li>
               {{-- <li class="">
                   <a href="{{ route('user.recording.all') }}"><i
                           class="ti ti-video me-2"></i>{{ __('general.all_recordings') }}</a>
               </li> --}}
               <li class="sidebar-dropdown d-none">
                   <a href="javascript:void(0)"><i class="ti ti-license me-2"></i>Example</a>
                   <div class="sidebar-submenu">
                       <ul>
                           <li><a href="comingsoon.html">Comingsoon</a></li>
                           <li><a href="maintenance.html">Maintenance</a></li>
                           <li><a href="error.html">Error</a></li>
                           <li><a href="thankyou.html">Thank You</a></li>
                       </ul>
                   </div>
               </li>
           </ul>
           <!-- sidebar-menu  -->
       </div>

   </nav>
   <!-- sidebar-wrapper  -->
