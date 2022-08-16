<!DOCTYPE html>
<html lang="en">
<head>

	<title>Arttales</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />

	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

	<!-- font css -->
	<link rel="stylesheet" href="assets/fonts/font-awsome-pro/css/pro.min.css">
	<link rel="stylesheet" href="assets/fonts/feather.css">
	<link rel="stylesheet" href="assets/fonts/fontawesome.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/customizer.css">

  
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    
    <style>
    .error{
        color: #FF0000; 
    }
    </style>
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

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
        @include('alert_message')
                
		<div class="card">
			<div class="row align-items-center text-center">
                
                <form class="login100-form validate-form"   method="post" action="{{ route('doLogin') }}">
                @csrf
				
                    <div class="col-md-12">
    					<div class="card-body">
                           <img src="assets/images/logo.png" alt="" class="img-fluid mb-4">
    						<h4 class="mb-3 f-w-400">Login</h4>
    						<div class="input-group mb-3">
    							<div class="input-group-prepend">
    								<span class="input-group-text"><i data-feather="mail"></i></span>
    							</div>
    							<input type="email" class="form-control" placeholder="Email address"
                                id="email" name="email">
    						</div>
    						<div class="input-group mb-4">
    							<div class="input-group-prepend">
    								<span class="input-group-text"><i data-feather="lock"></i></span>
    							</div>
    							<input type="password" class="form-control" placeholder="Password"
                                id="password" name="password">
    						</div>
    						<button type="submit" class="btn btn-block btn-primary mb-4">Log in</button>
    					</div>
    				</div>
                </form>
			</div>
		</div>
	</div>
</div>


<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Validation script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script>
   
    $("#login_form").validate({

      rules: {
        email: {
          required: true,
        },
        password: {
          required: true,
        },
      },
      messages: {
        email: {
            required: "Please enter companydddd email address",
        },

        password: {
            required: "Please enter password",
        },
      },
      submitHandler: function (form) {
        var formData = {  
          email    : $("#email").val(),
          password : $("#password").val(),
      
        };

        $.ajax({
          type: "POST",
          url: "{{ route('doLogin') }}",
          data: {
            "_token": "{{ csrf_token() }}",
            "data": formData
          },
          
          success: function(data){
            
          }
        });

      }
    })
</script>


</body>
</html>
