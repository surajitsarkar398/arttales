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
                            <h5 class="m-b-10">Add Store</h5>
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
            <div class="col-sm-6">
                <!-- Basic Inputs -->
               
                <!-- HTML Input Types -->
                <div class="card ">
                    <div class="card-header">
                        <h5>Add Store</h5>
                    </div>
                     @include('alertmessage')
                    <form  action="{{URL('/store/addstore/store')}}"  enctype="multipart/form-data" method="post">
                         @csrf
                    <div class="card-body">
                     <div class="form-group">
                           <input class="form-control p" type="text"  id="demo-text-input" name="store_name"placeholder="Enter Your StoreName">
                        </div>
                      <div class="form-group">    
                            <label for="demo-input-file" class="col-form-label">Choose Store Image</label>
                             <div id="t1">
                                <div class ="file_row d-flex">
                            <input class="form-control p" type="file" id="demo-input-file" name="store_image[]" multiple>
                            <input type='button' id='bt1' class="btn btn-light"    onclick="$(this).closest('DIV.file_row').remove();" value='Cancel'  />
                        </div>
                    </div>
                        </div>
                        <input type='button' id='bt' class="btn btn-light" onclick="onclickAddFile()" value='Add Image' style="padding: 5px; font-size: 12px; margin-left: 15px;" />

                                               <script>
                                               function onclickAddFile(){
                                                     var xyz = $('#t1').clone();
                                                     
                                                       $('#t1').after(xyz);
                                               }
                                                </script>
                                                <script>
                                               function onclickcancel(){
                                                
                                               }
                                               </script>
                          <div class="form-group">
                          <input class="form-control p" type="text"  id="demo-text-input" name="category" placeholder="Enter Your Store Category">
                        </div>
                       <div class="form-group">
                            <input class="form-control" type="tel"  id="demo-tel-input" placeholder="Enter Your Number" name="mobile">
                        </div>
                             <div class="form-group">
                            <input class="form-control" type="email" name="email"  id="demo-email-input" placeholder="Enter Your Email">
                        </div>
                           <div class="form-group">
                            <input class="form-control" type="text" name="website" placeholder="Enter Url" id="demo-URL-input">
                        </div>
                        <div class="form-group">
                           <input class="form-control p" type="text"  id="demo-text-input" name="address" placeholder="Enter Your Adress">
                        </div>
                          <div class="form-group">
                            <label for="demo-input-file" class="col-form-label">Add Your Attachment</label>
                           <input class="form-control p" type="file"  id="demo-text-input" name="attachment">
                        </div>
                    </div>
                     
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
