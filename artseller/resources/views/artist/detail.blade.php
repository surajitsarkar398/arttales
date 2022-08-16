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
                           <a href="{{ route('artist.detail',$artist->register_id) }}">
                                <h5 class="m-b-10"> Artist Detalis
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
                        <h4> Details of Your Artist</h4>
                    </div>
                    <div class="card-body">
                         @include('alert_message')
                        
                            <div class="row form-group">
                                <input type="hidden" name="register_id" value="{{ $artist ? 
                                $artist->register_id : '' }}">


                                <div class="col-lg-6">
                                    
                                    @if(!empty($artist))
                                         <img src="{{ URL('public/images/artist') }}/{{ $artist->image }}" alt="" height="80px" width="80px">
                                    @endif   
                                </div><br>
                                <div class="col-lg-6">
                                    <label class="lable">Name</label> 
                                    <input class="form-control" type="text" name="name" placeholder="Enter your name"
                                    value="{{ $artist ? $artist->name : '' }}" disabled>
                                </div>

                                <div class="col-lg-6">
                                    <label class="lable">Email Address</label> 
                                    <input class="form-control" type="email" name="email" placeholder="Enter valid email address"
                                    value="{{ $artist ? $artist->email : '' }}"
                                    disabled>
                                </div>    
                            </div>    
                            <div class="row formfields form-group">
                                <div class="col-lg-6">
                                    <label class="lable">Mobile Number</label> 
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="country_code" placeholder="+91"
                                            value="{{ $artist ? $artist->country_code : ''}}"disabled>
                                        </div>    
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" placeholder="Enter valid mobile number" name="mobile"
                                            value="{{ $artist ? $artist->mobile : '' }}"
                                            disabled>        
                                        </div>
                                    </div>    
                                </div>

                                <div class="col-lg-6">
                                    <label class="lable">Website</label> 
                                    <input class="form-control" type="text" name="website" placeholder="https://example.com"
                                    value="{{ $artist ? $artist->website : '' }}"
                                    disabled>
                                </div>    
                            </div>
                            <div class="row formfields form-group">
                                <div class="col-lg-6">
                                    <label class="lable">Date of Birth</label> 
                                    <input class="form-control" type="date" name = "dob"
                                    value="{{ $artist ? $artist->dob : ''  }}"
                                    disabled>   
                                </div>

                                

                            </div>
                            @if(empty($artist))
                                <div class="row formfields form-group">
                                    <div class="col-lg-6">
                                        <label class="lable">Password</label> 
                                        <input class="form-control" type="password" name="password" placeholder="Enter a valid password" id="password" disabled>
                                        
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="lable">Confirm password</label>
                                         <input class="form-control" type="password" name="repassword"  placeholder="Re-type your valid Password" disabled>
                                    </div>    
                                </div>
                            @endif()    
                            <div class="row formfields form-group">
                                <div class="col-lg-6">
                                    <label class="lable">Genres</label> 
                                    <input class="form-control" type="text" name="genres"placeholder="Enter Your Genres"
                                    value="{{ $artist ? $artist->genres : '' }}" disabled>
                                    
                                </div>

                                <div class="col-lg-6">
                                    <label class="lable">Major Achievment</label>
                                     <input class="form-control" type="text" name="major_achivement" placeholder="Enter Your Achievment"
                                     value="{{ $artist ? $artist->major_achivement : '' }}"
                                     disabled>
                                </div>    
                            </div>
                            <div class="row formfields form-group">
                                <div class="col-lg-6">
                                    <label class="lable">WorkPlace</label> 
                                    <input class="form-control" type="text" name="work_at" placeholder="Enter Your Work"
                                    value="{{ $artist ? $artist->work_at : '' }}"
                                    disabled>
                                    
                                </div>

                                <div class="col-lg-6">
                                    <label class="lable">Performance</label>
                                    <input class="form-control" type="text" name="performance" placeholder="Enter Your performance"
                                    value="{{ $artist ? $artist->performance : '' }}"
                                    disabled>
                                </div>    
                            </div>
                            <div class="row formfields form-group">
                                <div class="col-lg-4">
                                    <label class="lable">Select Category</label> 
                                    <select  name="category" id='category' class="form-control"  onchange="fetchSubcategory(this.id)" disabled>
                                      <option value="" selected disabled>Select</option>
                                        @foreach($prefrencelist as  $prefrence)
                                            @if(!empty($artist))
                                                <option @if($prefrence->id == $artist->main_category_name) selected @endif value="{{ $prefrence->id }}">
                                                    {{$prefrence->preferences_name }}
                                                </option>
                                            @else
                                                <option value="{{ $prefrence->id}}">{{$prefrence->preferences_name }}</option>
                                            @endif    
                                        @endforeach
                                    </select>
                                    
                                </div>

                             <div class="col-lg-4">
                                    <label class="lable">Select Subcategory</label>
                                        <div id="subcategory">
                                            @if(empty($artist))
                                              
                                                    <select name="subcategory" class="form-control" disabled >
                                                    <option value="" selected disabled>Select</option>
                                                    </select>
                                                
                                            @else
                                                <select name="subcategory" class="form-control" disabled>
                                                    <option value="" selected disabled>Select</option>

                                                        @foreach($prefrencesublist as  $prefrencesub)

                                                            @if(!empty($artist))
                                                                <option  @if($prefrencesub->preference_subcategories_id == $artist->sub_category_name) selected @endif value="{{ $prefrencesub->preference_subcategories_id }}">{{$prefrencesub->    preference_subcategories_name }}</option>
                                                            @else
                                                                <option value="{{ $prefrencesub->id }}">{{$prefrencesub->    preference_subcategories_name }}</option>
                                                            @endif    
                                                        @endforeach
                                                </select>
                                            @endif   
                                        </div>     
                                </div>  


                                <div class="col-lg-4">
                                    <label class="lable">Select Roles</label>
                                    <select class="form-control" name="role" disabled>
                                       <option value="select">Select</option>

                                        @if(!empty($artist))
                                            <option  @if($artist->user_type ===  'artist') selected @endif value="Artist" >Artist</option>
                                        @else
                                            <option  selected value="Artist" >Artist</option>
                                        @endif    
                                    </select>
                                </div>      
                            </div>
                            <div class="formfields form-group">
                                <label class="lable">About us</label>
                                <textarea class="form-control" name="description" placeholder="About your self..." disabled>{{ $artist ? $artist->description : ''}}</textarea>
                            </div>    

                            <div class="formfields text-right">
                                
                                <a href="{{ route('artist.index') }}"><button  class="btn btn-primary mr-2">Back</button></a>
                            </div>  
                         
                    </div>    
                </div>
            </div>        
        </div>   
    </div>    
    
</section>
<script type="text/javascript">

$(document).ready(function () {
 
      
    $('#artistForm').validate({ // initialize the plugin
     
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
     
            genres: {
              required: true,
            },
     
            major_achivement: {
                required: true,
            },

            work_at: {
                required: true,
            },     


            performance: {
                required: true,
            },        

            category: {
                required: true,
            },        

     
            subcategory: {
                required: true,
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

function fetchSubcategory(id){
    var categoryId = $('#category').val();

     $.ajax({
        url: "{{ route('artist.fetchSubCategory') }}",
        type: "post",

        data: { 
            "_token": "{{ csrf_token() }}",
            "categoryId" : categoryId,

        },
        success: function (response) {
            $('#subcategory').html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    

}
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
