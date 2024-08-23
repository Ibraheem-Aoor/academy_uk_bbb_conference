 <!-- Offcanvas Start -->
 <div class="offcanvas offcanvas-end shadow" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
     <div class="offcanvas-header p-4 border-bottom">
         <h5 id="offcanvasLeftLabel" class="mb-0">
             {{-- <img src="assets/images/logo-dark.png" height="24" class="light-version" alt="">
            <img src="{{ asset('assets/common/logo.png') }}" height="24" class="dark-version" alt=""> --}}
             {{ __('general.create_quick_meeting') }}
         </h5>
         <button type="button" class="btn-close d-flex align-items-center text-dark" data-bs-dismiss="offcanvas"
             aria-label="Close"><i class="uil uil-times fs-4"></i></button>
     </div>
     <div class="offcanvas-body p-4">
         <form action="{{ route('user.meeting.create_quick') }}" method="POST" class="custom-form">
             @csrf
             <div class="row">
                 <div class="col-12">
                     <div class="text-center">
                         <h6 class="fw-bold">Meeting Name</h6>
                         <input type="text" name="name" class="form-control">
                     </div>
                 </div>
                 <div class="col-12 mt-3">
                     <div class="text-center">
                         <button class="btn btn-soft-primary btn-lg">{{ __('general.create_quick_meeting') }}</button>
                     </div>
                 </div>
             </div>
         </form>
     </div>

     <div class="offcanvas-footer p-4 border-top text-center d-none">
         <ul class="list-unstyled social-icon social mb-0">
             <li class="list-inline-item mb-0"><a href="https://1.envato.market/landrick" target="_blank"
                     class="rounded"><i class="uil uil-shopping-cart align-middle" title="Buy Now"></i></a></li>
             <li class="list-inline-item mb-0"><a href="https://dribbble.com/shreethemes" target="_blank"
                     class="rounded"><i class="uil uil-dribbble align-middle" title="dribbble"></i></a></li>
             <li class="list-inline-item mb-0"><a href="https://www.behance.net/shreethemes" target="_blank"
                     class="rounded"><i class="uil uil-behance align-middle" title="behance"></i></a></li>
             <li class="list-inline-item mb-0"><a href="https://www.facebook.com/shreethemes" target="_blank"
                     class="rounded"><i class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
             <li class="list-inline-item mb-0"><a href="https://www.instagram.com/shreethemes/" target="_blank"
                     class="rounded"><i class="uil uil-instagram align-middle" title="instagram"></i></a></li>
             <li class="list-inline-item mb-0"><a href="https://twitter.com/shreethemes" target="_blank"
                     class="rounded"><i class="uil uil-twitter align-middle" title="twitter"></i></a></li>
             <li class="list-inline-item mb-0"><a href="mailto:support@shreethemes.in" class="rounded"><i
                         class="uil uil-envelope align-middle" title="email"></i></a></li>
             <li class="list-inline-item mb-0"><a href="https://shreethemes.in" target="_blank" class="rounded"><i
                         class="uil uil-globe align-middle" title="website"></i></a></li>
         </ul><!--end icon-->
     </div>
 </div>
 <!-- Offcanvas End -->


 <!-- Meeting URL Modal -->
 <div class="modal fade" id="meetingUrlModal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content rounded shadow border-0">
             <div class="modal-header border-bottom">
                 <h5 class="modal-title" id="modal-title">Join Meeting</h5>
                 <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                         class="uil uil-times fs-4 text-dark"></i></button>
             </div>
             <div class="modal-body">
                 <div class="p-3 rounded box-shadow text-center">
                     <p>Your meeting is ready. Click the button below to join:</p>
                     <a id="meetingUrl" href="#" target="_blank" class="btn btn-primary mb-3 text-center">Join Meeting</a>
                     <div class="input-group">
                         <input id="meetingUrlText" type="text" class="form-control" readonly>
                         <div class="input-group-append">
                             <button id="copyButton" class="btn btn-outline-secondary" type="button">Copy</button>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary"
                     data-bs-dismiss="modal">{{ __('general.close') }}</button>
             </div>
         </div>
     </div>
 </div>
