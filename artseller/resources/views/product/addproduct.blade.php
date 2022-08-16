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
                            <a href="{{ route('dashboard') }}">
                                <h5 class="m-b-10">Dashboard</h5>
                            </a>

                        </div>
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add Product</h5>
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
            <div class="col-sm-12" style="margin-top: 40px;">
                <!-- Basic Inputs -->

                <!-- HTML Input Types -->
                <div class="card ">
                    <div class="card-header">
                        <h5>Add Product</h5>
                    </div>
                    @include('alert_message')
                   
                    <form action="{{route('product.store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        
                        <div class="customdiv">
                            
                        <div class="card-body" id="div1">
                            <h4 style="font-weight:bold;color:red">Product Section:- 1</h4>
                            <button style="margin-left: 10px;"  class="btn btn-success btn-sm add_field_button">Add Product</button>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="demo-input-file" class="col-form-label">ProductName</label>
                                <input class="form-control p" type="text" id="demo-text-input" name="product_name1" placeholder="Enter Your ProductName">
                            </div>
                            <div class="form-group col-md-6" id="cloned">
                                <label for="demo-input-file" class="col-form-label">Choose Product Image</label>
                                <input type="file" name="product_image1[]" accept="image/*" required="required" class="form-control" multiple>
                            </div>
                            </div>

                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="demo-input-file" class="col-form-label">Enter Your Poduct Price</label>
                                <input class="form-control p" type="number" id="demo-text-input" name="price1" placeholder="Enter Your Poduct Price">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="demo-input-file" class="col-form-label">Discount</label>
                                <input class="form-control" type="number" id="demo-tel-input" placeholder="Enter Your Product Discount" name="discount1">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="demo-input-file" class="col-form-label">Offer Price</label>
                                <input class="form-control" type="number" id="demo-tel-input" placeholder="Enter Your Product Offer Price" name="offer_price1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="demo-input-file" class="col-form-label">Limited Stock</label>
                                <input class="form-control" type="number" id="demo-tel-input" placeholder="Enter Your Product Stock" name="limited_stock1">
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="demo-input-file" class="col-form-label">Product Description</label>
                                <textarea class="form-control" type="text" name="product_description1" id="demo-email-input" placeholder="Enter Your Product Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tot_div" value="1" id="tot_div">
                        <center><button type="submit" class="btn btn-primary mr-2" style="margin-bottom: 22px;width: 160px;">Submit</button></center>
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

    $(document).ready(function() {
        var max_fields = 100; //maximum input boxes allowed
        var wrapper = $(".customdiv"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button class

        var x = 1; //initial text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="card-body" id="div'+x+'"> <h4 style="font-weight:bold;color:red">Product Section:- '+x+'</h4>  <button style="margin-left: 10px;" class="btn btn-danger btn-sm remove_field">Remove Product</button> <div class="row"> <div class="form-group col-md-6"> <label for="demo-input-file" class="col-form-label">ProductName</label> <input class="form-control p" type="text" id="demo-text-input" name="product_name'+x+'" placeholder="Enter Your ProductName"> </div> <div class="form-group col-md-6" id="cloned"> <label for="demo-input-file" class="col-form-label">Choose Product Image</label> <input type="file" name="product_image'+x+'[]" accept="image/*" required="required" class="form-control" multiple> </div> </div> <div class="row"> <div class="form-group col-md-6"> <label for="demo-input-file" class="col-form-label">Enter Your Poduct Price</label> <input class="form-control p" type="number" id="demo-text-input" name="price'+x+'" placeholder="Enter Your Poduct Price"> </div> <div class="form-group col-md-6"> <label for="demo-input-file" class="col-form-label">Discount</label> <input class="form-control" type="number" id="demo-tel-input" placeholder="Enter Your Product Discount" name="discount'+x+'"> </div> </div> <div class="row"> <div class="form-group col-md-6"> <label for="demo-input-file" class="col-form-label">Offer Price</label> <input class="form-control" type="number" id="demo-tel-input" placeholder="Enter Your Product Offer Price" name="offer_price'+x+'"> </div> <div class="form-group col-md-6"> <label for="demo-input-file" class="col-form-label">Limited Stock</label> <input class="form-control" type="number" id="demo-tel-input" placeholder="Enter Your Product Stock" name="limited_stock'+x+'"> </div> </div> <div class="form-group"> <label for="demo-input-file" class="col-form-label">Product Description</label> <textarea class="form-control" type="text" name="product_description'+x+'" id="demo-email-input" placeholder="Enter Your Product Description"></textarea> </div> </div>'); //add input box
             
                $("#tot_div").val(x);
                $('html, body').animate({
                    scrollTop: $("#div"+x).offset().top
                }, 1000);
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove(); x--;
            $("#tot_div").val(x);
        })
    });
</script>


<!-- </body> -->


<!-- Mirrored from html.phoenixcoded.net/nextro-able/bootstrap/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Nov 2020 06:35:48 GMT -->
<!-- </html> -->

<!-- Mirrored from html.phoenixcoded.net/nextro-able/bootstrap/default/form2_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Nov 2020 06:35:58 GMT -->