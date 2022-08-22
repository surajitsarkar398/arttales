@extends('layout.master')
@section('master')

<!-- <!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="build/css/intlTelInput.css">

</head>
<body> -->
	<!-- [ Main Content ] start -->
<section class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                      <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add Seller</h5>
                        </div>
                    <div class="col-md-12">
                   <!--      <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Add Artist Lover</a></li>
                        </ul> -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="form-row">
            <!-- [ form-element ] start -->
            <div class="col-sm-12">
                <!-- Basic Inputs -->
               
                <!-- HTML Input Types -->
                <div class="card ">
                    <div class="card-header">
                        <h5>Add Seller</h5>
                    </div>
                     {{-- @include('alertmessage') --}}
                    <form  action="{{URL('seller/store')}}"  enctype="multipart/form-data" method="post">
                         @csrf
                    <div class="card-body">
                        <div class="row">
                      <div class="form-group col-md-3">    
                            <label for="demo-input-file" class="col-form-label">Choose Profile Image</label>
                            <input class="form-control p" type="file" id="demo-input-file" name="image">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="demo-input-file" class="col-form-label">Enter Name</label>
                           <input class="form-control p" type="text"  id="demo-text-input" name="name"placeholder="Enter Your Name">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="demo-input-file" class="col-form-label">Country Code</label>
                            <input class="form-control p" type="text"  id="demo-text-input" name="country_code" placeholder="CountryCode">

                        </div>
                        <div class="form-group col-md-5">
                            <label for="demo-input-file" class="col-form-label">Mobile Numnber</label>
                            <input class="form-control" type="tel"  id="demo-tel-input" placeholder="Enter Your Number" name="mobile">
                        </div>
                    </div>
                        
                       <div class="row">
                          <div class="form-group col-md-3">
                            <label for="demo-date-only" class="col-form-label">Date Of Birth</label>
                            <input class="form-control" type="date" name="dob" id="demo-date-only">
                        </div>
                         <div class="form-group col-md-3">
                            <label for="demo-date-only" class="col-form-label">Email</label>
                            <input class="form-control" type="email" name="email"  id="demo-email-input" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="demo-date-only" class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="password" id="demo-password-input"  placeholder="Enter Your Password">
                        </div>
                          <div class="form-group col-md-3">
                            <label for="demo-date-only" class="col-form-label">Retype Password</label>
                            <input class="form-control" type="password" name="repasswprd" id="demo-password-input"  placeholder="ReEnter Your Password">
                        </div>
                    </div>
                        <input type="hidden" name="user_type" value="seller">
                        <div class="form-group">
                            <label for="demo-option-input " class="col-form-label " name="role">Select Role</label>
                         <select class="form-control p" id="selectUser"name="role">
                                  <option value="select">Select</option>
                                  <option value="Seller">Seller</option>
                                  </select>
                  
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                     
                       
                    </form>
                </div>
            </div>
       
        <!-- [ Main Content ] end -->

    </div>
</section>
<!-- [ Main Content ] end -->
</div>

@endsection
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <script src="{{URL('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{URL('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{URL('assets/js/plugins/feather.min.js')}}"></script>
    <script src="{{URL('assets/js/pcoded.min.js')}}"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="{{URL('assets/js/plugins/clipboard.min.js')}}"></script>
    <script src="{{URL('assets/js/uikit.min.js')}}"></script>


<script>
    // header option
    $('#pct-toggler').on('click', function() {
        $('.pct-customizer').toggleClass('active');

    });
    // header option
    $('#cust-sidebrand').change(function() {
        if ($(this).is(":checked")) {
            $('.theme-color.brand-color').removeClass('d-none');
            $('.m-header').addClass('bg-dark');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            $('.theme-color.brand-color').addClass('d-none');
        }
    });
    // Header Color
    $('.brand-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        // $('.header-color > a').removeClass('active');
        // $('.pcoded-header').removeClassPrefix('brand-');
        // $(this).addClass('active');
        if (temp == "bg-default") {
            $('.m-header').removeClassPrefix('bg-');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
            $('.m-header').addClass(temp);
        }
    });
    // Header Color
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        // $('.header-color > a').removeClass('active');
        // $('.pcoded-header').removeClassPrefix('brand-');
        // $(this).addClass('active');
        if (temp == "bg-default") {
            $('.pc-header').removeClassPrefix('bg-');
        } else {
            $('.pc-header').removeClassPrefix('bg-');
            $('.pc-header').addClass(temp);
        }
    });
    // sidebar option
    $('#cust-sidebar').change(function() {
        if ($(this).is(":checked")) {
            $('.pc-sidebar').addClass('light-sidebar');
            $('.pc-horizontal .topbar').addClass('light-sidebar');
            // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
        } else {
            $('.pc-sidebar').removeClass('light-sidebar');
            $('.pc-horizontal .topbar').removeClass('light-sidebar');
            // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
        }
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
</script>


<!-- </body> -->


<!-- Mirrored from html.phoenixcoded.net/nextro-able/bootstrap/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Nov 2020 06:35:48 GMT -->
<!-- </html> -->

<!-- Mirrored from html.phoenixcoded.net/nextro-able/bootstrap/default/form2_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Nov 2020 06:35:58 GMT -->
