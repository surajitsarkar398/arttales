	<div class="row">
		<div class="col-md-4">
			<label for="store_name"><b>Ads Type: </b></label>
		</div>
		<div class="col-md-8">
			{{ $adslist->ads_type }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="store_name"><b>User name: </b></label>
		</div>
		<div class="col-md-8">
			{{ $adslist->name }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="store_name"><b>store Name  : </b></label>
		</div>
		<div class="col-md-8">
			{{ $adslist->store_name }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="category"><b>category : </b></label>
		</div>
		<div class="col-md-8">
			{{ $adslist->category }}
		</div>
	</div>
	<hr> 
	<div class="row">
		<div class="col-md-4">
			<label for="mobile"><b>Audience Type : </b></label>
		</div>
		<div class="col-md-8">
			{{ $adslist->audience_type }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="email"><b>Budget : </b></label>
		</div>
		<div class="col-md-8">
			{{ $adslist->budget }}
		</div>
	</div>
	<hr>
		<div class="row">
			<div class="col-md-4">
				<label for="website"><b>Duration : </b></label>
			</div>
			<div class="col-md-8">
				{{ $adslist->duration }}
			</div>
		</div>
		<hr>

	<div class="row">
		<div class="col-md-4">
			<label for="address"><b>Payment Method : </b></label>
		</div>
		<div class="col-md-8">
		   {{ $adslist->payment_method }}
		</div>
	</div>
	<hr>
  
	


<script>
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script> 