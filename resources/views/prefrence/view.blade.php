@extends('layout.master')
@section('master')


 <!-- data tables css -->
    <link rel="stylesheet" href="{{URL('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    <!-- font css -->
  
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
                           <a href="{{ route('prefrence.index')  }}"><h5 class="m-b-10">Prefrence List</h5></a>
                        </div>
                        <a data-toggle="modal" data-target="#addPrefrence" class="btn btn-danger mr-2 text-white" style="float:right;">
                            Add
                        </a>    
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Zero config table start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">    
                            <div class="col-lg-8" style="margin-top:10px;">
                                <h4>Manage Prefrence</h4>
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
                                         <th>Name</th>
                                         <th>Action</th>

                                      
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse($prefrencelist as $no => $prefrence)
                                         <tr>    
                                            <td>{{ $no +1 }}</td>
                                            <td>{{ $prefrence->preferences_name }}</td>
                                            <td>
                                               
                                                <a href="{{route('prefrence.edit',$prefrence->id) }}">
                                                    <i class="fas fa-edit"  aria-hidden="true"></i>
                                                </a>
                                                &nbsp;&nbsp;
                                            
                                                <a href="{{route('prefrence.destroy',$prefrence->id) }}">
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
                                    </tr>    
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <div class="d-flex float-right">
                            {!! $prefrencelist->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            
           
      
      
            
          
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
<!-- [ Main Content ] end -->
</div>

<div class="modal fade" id="addPrefrence" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Prefrence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  action="{{ route('prefrence.store') }}"  enctype="multipart/form-data" method="post" id="preferenceForm">
                     @csrf
                <div class="card-body">
                    <div class="form-group">
                       <label>Enter Prefrence Name</label> 
                       <input class="form-control" type="text"  id="demo-text-input" name="preferences_name"placeholder="Enter Your Prefrence">
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@if(!empty($editPreference))
    <div class="modal fade show" id="editPrefrence" tabindex="-1" role="dialog" 
        aria-hidden="true" style="padding-right: 15px; display: block; background-color: rgba(100, 100, 100, 0.5);" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Prefrence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{ route('prefrence.update') }}"  enctype="multipart/form-data" method="post" id="preferenceForm">
                         @csrf
                    <div class="card-body">
                        <div class="form-group">
                           <input type="hidden" name="preferences_id" value="{{ $editPreference->id }}"> 
                           <label>Enter Prefrence Name</label> 
                           <input class="form-control" type="text"  id="demo-text-input" name="preferences_name"placeholder="Enter Your Prefrence"
                           value="{{ $editPreference->preferences_name}}">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
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


$(document).ready(function () {
 
      
    $('#preferenceForm').validate({ // initialize the plugin
     
        rules: {
            preferences_name: { 
                required: true
            },
     
        
        }
     
    });
    
 
});

function closePopup(){

   $('#editPrefrence').removeAttr('style'); 
}

function doSearch(){

  var query=$("#search").val();

  $.ajax({
      url: "{{ route('prefrence.search') }}",
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




