@extends('layout.master')
@section('master')

<!-- <!DOCTYPE html>
<html lang="en"> -->

<!-- Mirrored from html.phoenixcoded.net/nextro-able/bootstrap/default/dt_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Nov 2020 06:37:23 GMT -->
<!-- <head> -->
 <!-- data tables css -->
    <link rel="stylesheet" href="{{URL('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    <!-- font css -->
  

    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:1951099,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Mobile header ] start -->
    <div class="pc-mob-header pc-header">
        <div class="pcm-logo">
            <img src="assets/images/logo.svg" alt="" class="logo logo-lg">
        </div>
        <div class="pcm-toolbar">
            <a href="#!" class="pc-head-link" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
                <!-- <i data-feather="menu"></i> -->
            </a>
            <a href="#!" class="pc-head-link" id="headerdrp-collapse">
                <i data-feather="align-right"></i>
            </a>
            <a href="#!" class="pc-head-link" id="header-collapse">
                <i data-feather="more-vertical"></i>
            </a>
        </div>
    </div>
    

<!-- [ Main Content ] start -->
<section class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title" style="margin-top:10px;">
                            <a href="{{ route('dashboard') }}"><h5 class="m-b-10">Dashboard</h5></a>
                        </div>
                        <div class="page-header-title">
                           <a href="{{ route('artist.index')  }}"><h5 class="m-b-10">Artist List</h5></a>
                        </div>
                        <a href="{{ route('artist.create')  }}" class="btn btn-danger mr-2" style="float:right;">
                            Add
                        </a>    
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

          
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">    
                            <div class="col-lg-8" style="margin-top:10px;">
                                <h4>Manage Artist</h4>
                            </div>    
                            <div class="col-lg-4" style="float:right">
                                <input type="text" id="search"  name="search" class="form-control" placeholder="Search"  onkeyup="doSearch()">
                            </div>     
                        </div>          
                    </div>
                    <div class="card-body">
                        @include('alert_message')
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Dob</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $no => $user)
                                        <tr>
                                            <td>{{ $no +1 }}</td>
                                            <td>
                                                @if($user->image != null) 
                                                    <img src="{{ URL('public/images/register') }}/{{ $user->image }}" alt="" height="50px" width="50px">
                                                @else
                                                    <img src="public/images/avatar.png" alt="" height="50px" width="50px">
                                                @endif    
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>({{ $user->country_code }}) {{ $user->mobile }}</td>
                                            <td>
                                                @php
                                                    $date = str_replace('/', '-',  $user->dob);
                                    
                                                @endphp
                                                {{ date('d-M-y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                @if($user->status == 0)
                                                    <a onClick="ChangeStatus({{$user->register_id}}, 1)" style="cursor:pointer">
                                                        <button class="btn btn-success btn-sm">
                                                          Active
                                                        </button>
                                                    </a>    
                                                @else
                                                    <a onClick="ChangeStatus({{$user->register_id}}, 0)" style="cursor:pointer">

                                                       <button class="btn btn-danger btn-sm">
                                                        Block
                                                        </button>
                                                    </a>    
                                                @endif()  
                                            </td>
                                            <td>
                                                <a href="{{route('artist.detail',$user->register_id) }}">
                                                    <i class="fa fa-eye" aria-hidden="true" 
                                                    style="color:green;"></i>
                                                </a>
                                                &nbsp;&nbsp;
                                               
                                                <a href="{{route('artist.edit',$user->register_id) }}">
                                                    <i class="fas fa-edit"  aria-hidden="true"></i>
                                                </a>
                                                &nbsp;&nbsp;
                                            
                                                <a href="{{route('artist.destroy',$user->register_id) }}">
                                                    <i class="fa fa-trash" aria-hidden="true"
                                                    style="color:red"></i>
                                                </a>
                                            </td>
                                        
                                        </tr>  
                                       @empty
                                        <tr class="text-center">
                                          <td colspan="8">No record found </td>
                                        </tr> 
                                      @endforelse  
                                </tbody>
                                <tfoot>
                            
                                </tfoot>
                            </table>
                        </div>
                        <br/>
                        <div class="d-flex float-right">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero config table end -->
           
      
      
            
          
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
<!-- [ Main Content ] end -->
</div>
@endsection
   
    <script src="{{URL('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{URL('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{URL('assets/js/plugins/feather.min.js')}}"></script>
    <script src="{{URL('assets/js/pcoded.min.js')}}"></script>
    <script src="{{URL('assets/js/highlight.min.js')}}"></script>
    <script src="{{URL('assets/js/plugins/clipboard.min.js')}}"></script>
    <script src="{{URL('assets/js/uikit.min.js')}}"></script>

<!-- datatable Js -->
<script src="{{URL('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{URL('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL('assets/js/pages/data-basic-custom.js')}}"></script>

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

<script type="text/javascript">
    function ChangeStatus(Id, Status)
    {

        $("#LoadingProgress").fadeIn('fast');
        
        $.ajax({
            url: "{{ URL('/artist/ChangeStatus') }}/"+Id+"/"+Status,
            type: "GET",
            contentType: false,
            cache: false,
            processData:false,
            success: function( data, textStatus, jqXHR ) {
                window.location.reload();
                $("#LoadingProgress").fadeOut('fast');
            },
            error: function( jqXHR, textStatus, errorThrown ) {
            
            }
        });
    }

    function doSearch(){

      var query=$("#search").val();

      $.ajax({
          url: "{{ route('artist.search') }}",
          type: 'GET',
          data: {
            keyword:query,
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },

          success: function (data) {
            $('tbody').html(data);
          }
      });

    }
</script>


<!-- </body> -->

<!-- Mirrored from html.phoenixcoded.net/nextro-able/bootstrap/default/dt_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Nov 2020 06:37:24 GMT -->
<!-- </html> -->
