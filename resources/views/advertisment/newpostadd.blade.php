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
                           <a href="">
                                <h5 class="m-b-10">
                                    
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
                        <h4>  Promotion Post</h4>
                    </div>
                    <div class="card-body">
                         @include('alert_message')
                        <form action="{{route('new_post_add_store')}}" method="POST" id=" "  enctype="multipart/form-data" >
                            @csrf
                            <div class="row form-group">
                             
                                <div class="col-lg-12">
                                    <label class="lable">Select Product</label><br>
                                    <div class="row">
                                        
                                        @foreach ($postlist as $item)
                                            
                                        
                                        <div class="col-sm-2 text-center">
                                            <label class="image-checkbox" title="England">
                                                <?php 
                                                $images=explode(',',$item->post_image);
                                                ?>
                                              <img height="100px;" src="{{ URL('public/images/post') }}/{{ $images[0] }}" />
                                             
                                                <input type="checkbox" name="post[]" value="{{$item->post_id}}"  />
                                            </label>
                                        </div>
                                       
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label class="lable">Budget</label> 
                                    <input class="form-control" onkeyup="cal_spend()" id="budget" type="number" name="budget" placeholder="Budget"
                                    value="">
                                </div> 
                                <div class="col-lg-4">
                                    <label class="lable">Duration</label> 
                                    <input class="form-control" onkeyup="cal_spend()" id="duration" type="duration" name="duration" placeholder="Duration"
                                    value="">
                                </div>    
                            </div>    
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="lable">Estimated Reach</label>
                                        <b>250-180</b> 
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="lable">Total Spend</label>
                                        <b id="tot_spend">0 Rs</b> 
                                        <input type="hidden" name="tot_spend" id="tot_spend_val">
                                    </div>
                                </div>
                           
                            
                            
                           
                           
                            <div class="formfields text-right">
                                <a href="{{ route('artist.index') }}"><button  class="btn btn-danger mr-2">Cancel</button></a>
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
<script>


</script>
<script type="text/javascript">
    jQuery(function ($) {
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }
            else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            if ($(this).hasClass('image-checkbox-checked')) {
                $(this).removeClass('image-checkbox-checked');
                $(this).find('input[type="checkbox"]').first().removeAttr("checked");
            }
            else {
                $(this).addClass('image-checkbox-checked');
                $(this).find('input[type="checkbox"]').first().attr("checked", "checked");
            }

            e.preventDefault();
        });
    });
   function cal_spend()
   {
        var budget=Number($("#budget").val());
        var duration=Number($("#duration").val());
        var tot_budget=budget*duration;
        var tax=tot_budget*18/100;
        var tot_cost=tot_budget+tax;
        $("#tot_spend").html(tot_cost);
        $("#tot_spend_val").val(tot_cost);
   }
</script>
<style>
    .image-checkbox
    {
        cursor: pointer;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 4px solid transparent;
        outline: 0;
    }

        .image-checkbox input[type="checkbox"]
        {
            display: none;
        }

    .image-checkbox-checked
    {
        border-color: #f58723;
    }
</style>

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
