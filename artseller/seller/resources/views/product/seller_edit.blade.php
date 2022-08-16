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
                      <div class="page-header-title" style="margin-top:10px;">
                            <a href="{{ route('dashboard') }}"><h5 class="m-b-10">Dashboard</h5></a>
                        </div>
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit Product</h5>
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
            <div class="col-sm-6"style="margin-top: 40px;">
                <!-- Basic Inputs -->
               
                <!-- HTML Input Types -->
                <div class="card ">
                <div class="card-header">
                        <h5>Add Product</h5>
                    </div>
                    
                     @include('alert_message')
                    <form  action="{{route('product.saveEdit')}}"  enctype="multipart/form-data" method="post">

                        <input type="hidden" name="products_id" 
                        value='{{  $productlist->product_id }}'> 

                         @csrf
                    <div class="card-body">
                     <div class="form-group">
                           <input class="form-control p" type="text"  id="demo-text-input" name="product_name" value='{{  $productlist->product_name }}' readonly>
                        </div>
                      <div class="form-group">    
                            <label for="demo-input-file" class="col-form-label">Choose Product Image</label>

                            @foreach(explode(',',$productlist->product_image)  as $images)
                             <div class ="file_rows">
                       <img src="{{ URL('public/images/product') }}/{{ $images }}" alt="" height="50px" width="50px" readonly>
                       <input type='button' id='bt2' class="btn btn-light remove" onclick="$(this).closest('DIV.file_rows').remove();" value='delete' style="padding: 0px 9px 0px;  font-size: 12px;  height: 38px; padding-bottom: 0px;"/>
                            </div>
                            @endforeach
                    
                             </div><br>
                                <div class="form-group col-md-12" id="cloned">
                                    <div id="t1">
                                        <div class ="file_row d-flex">
                                <input type="file" name="product_image[]" value ='{{  $productlist->product_image }}' class="form-control" id="t1"  style="margin-top:5px" multiple />
                                <input type='button' id='bt1' class="btn btn-light" onclick="$(this).closest('DIV.file_row').remove();"    value='Cancel' style="padding: 0px 25px 4px;  font-size: 12px; margin-left: 12px; height: 38px; padding-bottom: 0px;" />
                                                    
                                            </div>
                                        </div>
                                        </div>
                                        <input type="button" class="btn btn-light" id="bt" onclick="onclickAddFile()" value="Add Image" style="margin-left: 2%;margin-bottom: 13px;">
                                             
                                               <script>
                                               function onclickAddFile(){
                                                     var xyz = $('#t1').clone();
                                                       $('#t1').after(xyz);
                                               }
                                               </script>
                                          

                       
                          <div class="form-group">
                          <input class="form-control p" type="text"  id="demo-text-input" name="price" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text"  id="demo-tel-input"  name="discount" placeholder="Discount">
                        </div>
                          <div class="form-group">
                            <input class="form-control" type="text"  id="demo-tel-input" name="offer_price" placeholder="Offer_price" >
                        </div>
                         <div class="form-group">
                            <input class="form-control" type="text" name="product_description"  id="demo-email-input" placeholder="Product_description" >
                        </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="limited_stock"  id="demo-email-input" placeholder="Limited_stock" >
                        </div>
                    </div>
                     
                        <center><button type="submit" class="btn btn-primary mr-2" style="margin-bottom: 22px;width: 160px;">Save Product</button></center>
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
