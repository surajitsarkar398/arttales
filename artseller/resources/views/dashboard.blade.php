@extends('layout.master')
@section('master')


<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <!--  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Dashboard sale</li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        
        <div class="row">
            <!-- [ daily sales section ] start -->
            <div class="col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                     
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                            <select name="sale_type" id="" class="form-control">
                                <option value="">Select A Option</option>
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-success" value="Filter Now">
                                </div>
                            </div>
                        </form><br>
                        <table class="table">
                            <thead>
                              <tr>
                                <th>Sale Type</th>
                                <th>Total Sale</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?php if(isset($_GET['sale_type']) && $_GET['sale_type']=='monthly'){ echo 'Monthly Sales';} 
                                if(isset($_GET['sale_type']) && $_GET['sale_type']=='yearly'){ echo 'Yearly Sales';}
                                if(isset($_GET['sale_type']) && $_GET['sale_type']=='daily'){ echo 'Daily Sales';}
                                if(!isset($_GET['sale_type'])) { echo 'Daily Sales'; }
                                ?></td>
                                <td>Rs. <?php echo  number_format($data['total_sale'],2); ?></td>
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>

                    
                    
                </div>
            </div>

            <div class="col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                     
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                            <select name="order_type" id="" class="form-control">
                                <option value="">Select A Option</option>
                                <option value="successfull">Successfull Order</option>
                                <option value="pending">Pending Order</option>
                                <option value="cancelled">Cancelled Order</option>
                            </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-success" value="Filter Now">
                                </div>
                            </div>
                        </form><br>
                        <table class="table">
                            <thead>
                              <tr>
                                <th>Order Type</th>
                                <th>Total Order</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?php if(isset($_GET['order_type']) && $_GET['order_type']=='pending'){ echo 'Pending Order';} 
                                if(isset($_GET['order_type']) && $_GET['order_type']=='cancelled'){ echo 'Cancelled Order';}
                                if(isset($_GET['order_type']) && $_GET['order_type']=='successfull'){ echo 'Successfull Order';}
                                if(!isset($_GET['order_type'])) { echo 'Successfull Order'; }
                                ?></td>
                                <td><?php echo  $data['total_order']; ?></td>
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>

                    
                    
                </div>
            </div>

            
            <!-- [ daily sales section ] end -->
            <!-- [ Monthly  sales section ] start -->
           
            <!-- [ Monthly  sales section ] end -->
            <!-- [ year  sales section ] start -->
            
            <!-- [ year  sales section ] end -->
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center">Products</h3>
                            </div>
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Remaining Stock</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                    @foreach ($data['total_product'] as $item)
                                     <tr>
                                    <td>{{$item->product_id}}</td>
                                   <td>{{$item->product_name}}</td>
                                   <td>
                                    @foreach(explode(',',$item->product_image)  as $images)
                                   <img src="{{ URL('public/images/product') }}/{{ $images }}" alt="" height="50px" width="50px">
                                    @endforeach
                               </td>
                                   <td>{{$item->limited_stock}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              <div class="d-flex float-right">
                                {!! $data['total_product']->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         



        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
</div>
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
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="../../../../cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="assets/js/plugins/clipboard.min.js"></script>
<script src="assets/js/uikit.min.js"></script>

<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>

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

<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

@endsection