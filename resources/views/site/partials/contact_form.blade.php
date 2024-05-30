<div class="col-lg-7">
    <div class="section-title position-relative mb-4">
        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Need Help?</h6>
        <h1 class="display-5">Send Us A Message</h1>
    </div>
    <div class="contact-form">
        <form class="custom-form" action="{{ route('site.contact.submit') }}" method="POST">
            <div class="row">
                <div class="col-6 form-group">
                    <input type="text" class="form-control border-top-0 border-right-0 border-left-0 p-0"
                        placeholder="Your Name" name="name" required="required">
                </div>
                <div class="col-6 form-group">
                    <input type="email" class="form-control border-top-0 border-right-0 border-left-0 p-0"
                        placeholder="Your Email" name="email" required="required">
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control border-top-0 border-right-0 border-left-0 p-0"
                    placeholder="Subject" name="subject" required="required">
            </div>
            <div class="form-group">
                <textarea class="form-control border-top-0 border-right-0 border-left-0 p-0" rows="5" placeholder="Message"
                    required="required" name="message"></textarea>
            </div>
            <div>
                <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
            </div>
        </form>
    </div>
</div>

