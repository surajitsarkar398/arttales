@extends('layout.master')
@section('master')


<!-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet">     -->
<link rel="stylesheet" href="{{URL('build/css/intlTelInput.css')}}">




	<!-- [ Main Content ] start -->
<section class="pc-container">
    <div class="pcoded-content">
       
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                            <div class="page-header-title">

                            <a href="{{ route('dashboard') }}"><h5 class="m-b-10">Dashboard</h5></a>
                        </div>
                        <div class="page-header-title">
                           <a href="{{ $artistLover ? route('artist-lover.edit',$artistLover->register_id)  : route('artist-lover.create')  }}">
                                <h5 class="m-b-10">
                                    {{ $artistLover ? 'Edit Artist Lover': 'Add Artist Lover' }}
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4> {{ $artistLover ? 'Edit' : 'Create' }} Your Artist Lover </h4>
                    </div>
                    <div class="card-body">
                         @include('alert_message')
                        <form action="{{ $artistLover ? route('artist-lover.update') : route('artist-lover.store') }}" method="POST" id="{{ $artistLover ? '' :'artistLoverForm' }}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row form-group">
                                <input type="hidden" name="register_id" value="{{ $artistLover ? $artistLover->register_id : '' }}">

                                <div class="col-lg-6">
                                    <label class="lable">Name</label> 
                                    <input class="form-control" type="text" name="name" placeholder="Enter your name"
                                    value="{{ $artistLover ? $artistLover->name : '' }}">
                                </div>

                                <div class="col-lg-6">
                                    <label class="lable">Email Address</label> 
                                    <input class="form-control" type="email" name="email" placeholder="Enter valid email address"
                                    value="{{ $artistLover ? $artistLover->email : '' }}">
                                </div>    
                            </div>    
                            <div class="row formfields form-group">
                                <div class="col-lg-6">
                                    <label class="lable">Mobile Number</label> 
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="country_code" placeholder="+91"
                                            value="{{ $artistLover ? $artistLover->country_code : ''}}">
                                        </div>    
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" placeholder="Enter valid mobile number" name="mobile"
                                            value="{{ $artistLover ? $artistLover->mobile : '' }}">        
                                        </div>
                                    </div>    
                                </div>

                                <div class="col-lg-6">
                                    <label class="lable">Website</label> 
                                    <input class="form-control" type="text" name="website" placeholder="https://example.com"
                                    value="{{ $artistLover ? $artistLover->website : '' }}">
                                </div>    
                            </div>
                            <div class="row formfields form-group">
                                <div class="col-lg-6">
                                    <label class="lable">Date of Birth</label> 
                                    <input class="form-control" type="date" name = "dob"
                                    value="{{ $artistLover ? $artistLover->dob : ''  }}">   
                                </div>

                                <div class="col-lg-6">
                                    <label class="lable">Choose Profile Image</label>
                                    <input class="form-control" type="file" name="image">
                                    <br/>
                                    @if(!empty($artistLover))
                                         <img src="{{ URL('public/images/artistLover') }}/{{ $artistLover->image }}" alt="" height="80px" width="80px">
                                    @endif   
                                </div> 


                            </div>
                            @if(empty($artistLover))
                                <div class="row formfields form-group">
                                    <div class="col-lg-6">
                                        <label class="lable">Password</label> 
                                        <input class="form-control" type="password" name="password" placeholder="Enter a valid password" id="password">
                                        
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="lable">Confirm password</label>
                                         <input class="form-control" type="password" name="repassword"  placeholder="Re-type your valid Password">
                                    </div>    
                                </div>
                            @endif()    
                            
                            <div class="row">
                                <div class="col-lg-12"> 
                                    <label class="lable">Select Roles</label>
                                    <select class="form-control" name="role">
                                       <option value="select">Select</option>

                                        @if(!empty($artistLover))
                                            <option  @if($artistLover->user_type ===  'artist_lover') selected @endif value="ArtistLover" >Artist Lover</option>
                                        @else
                                            <option  selected value="ArtistLover" >Artist Lover</option>
                                        @endif    
                                    </select>
                                </div>
                            </div>    
                            <div class="formfields form-group">
                                <label class="lable">About us</label>
                                <textarea class="form-control" name="description" placeholder="About your self...">{{ $artistLover ? $artistLover->description : ''}}</textarea>
                            </div>    

                            <div class="formfields text-right">
                                <a href="{{ route('artist-lover.index') }}"><button  class="btn btn-danger mr-2">Cancel</button></a>
                                <button  type="submit" class="btn btn-primary mr-2">Save</button>
                            </div>  
                        </form>      
                    </div>    
                </div>
            </div>        
        </div>   
    </div>    
    
</section>
<script type="text/javascript">

$(document).ready(function () {
 
      
    $('#artistLoverForm').validate({ // initialize the plugin
     
        rules: {
            name: { 
                required: true
            },
     
            email: {
                required: true,
                email: true

            },
     
            mobile: {
                required: true,
                digits: true,
                minlength:10
            },
     
            country_code: {
                required: true,
                minlength: 3
            },
     
            website: {
                required: true,
                url:true
            },
     
            password: {
     
                required: true,
                minlength: 6
     
            },
     
            repassword: {
                required: true,
                minlength:6,
                equalTo : "#password"
            },
     
            role: {
                required: true,
            },        

            description: {
                required: true,
            }, 
     
            dob:{
                required:true,

            },
            image: {
                required: true,
                extension: "jpeg,png,jpg,gif,svg"

            },
     
        }
     
    });
    
 
});


</script>

@endsection
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
<!-- country code script -->
<!-- Use as a Vanilla JS plugin -->
<script src="{{URL('build/js/intlTelInput.min.js')}}"></script> 

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="{{URL('build/js/intlTelInput-jquery.min.js')}}"></script> 

<script type="text/javascript">
    
    // Vanilla Javascript
var input = document.querySelector("#telephone");
intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: function(success, failure) {
        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            success(countryCode);
        });
    },
    utilsScript: "js/utils.js"
});
</script>



<!-- <script type="text/javascript">
    // Vanilla Javascript

$("#telephone").intlTelInput({
  // options here
  intinalCountry : "auto",
  geoIpLookup : function(callback){
    jquery.get('https://info.io', function() {}, "jsonp").always(function(resp){
            var countryCode = (resp && resp.country) ? resp.country :"";
            callback(countryCode);


        });
},
  utilsScript : 'js/utils.js'

});
</script> -->
<!-- Mirrored from html.phoenixcoded.net/nextro-able/bootstrap/default/form2_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Nov 2020 06:35:58 GMT -->
