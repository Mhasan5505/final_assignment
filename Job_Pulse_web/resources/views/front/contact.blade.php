@extends('front.layouts.app')

@section('main')
<section class="contact py-5" id="contact">
    <div class="container py-3">
        <h3 class="heading">Contact</h3>
        <div class="row contact-grids">
            <div class="col-lg-5 contact-left">
                <h4 class="mb-4">Address Info</h4>
                <div class="row">
                    <div class="col-1 pr-0 icon">
                        <span class="fa fa-map-marker" aria-hidden="true"></span>
                    </div>
                    <div class="col-11">
                        <p>Satarkul, Uttar Badda,</p>
                        <p> Dhaka-1212</p>
                    </div>
                    <div class="col-1 pr-0 icon my-2">
                        <span class="fa fa-phone" aria-hidden="true"></span>
                    </div>
                    <div class="col-11 my-2">
                        <p> 01825830912</p>
                    </div>
                    <div class="col-1 pr-0 icon">
                        <span class="fa fa-envelope-open" aria-hidden="true"></span>
                    </div>
                    <div class="col-11">
                        <p><a href="mh12256634@gmail.com"> mh12256634@gmail.com</a></p>
                    </div>
                    <div class="map col-sm-11 mt-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470028.2652318057!2d91.13194396503246!3d23.02025366143058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37536821ff0c2e39%3A0xf094eed60ba43331!2sFeni%20District!5e0!3m2!1sen!2sbd!4v1679933767813!5m2!1sen!2sbd"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mt-lg-0 mt-5 contact-right">
                <h4 class="mb-4">Get In Touch</h4>
                <form action="#" method="post">
                    <label><span class="fa mr-2 fa-user" aria-hidden="true"></span> Name</label>
                    <input type="text" name="Name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
                    <div class="clearfix"></div>
                    <label><span class="fa mr-2 fa-envelope-open" aria-hidden="true"></span>Email</label>
                    <input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                    <div class="clearfix"></div>
                    <label><span class="fa mr-2 fa-phone" aria-hidden="true"></span>Phone</label>
                    <input type="text" name="Phone" value="Phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}" required="">
                    <div class="clearfix"></div>
                    <label><span class="fa mr-2 fa-edit" aria-hidden="true"></span>Message</label>
                    <textarea name="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
                    
                    <button type="submit" class="btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection