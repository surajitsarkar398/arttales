	<div class="row">
		<div class="col-md-4">
			<label for="store_name"><b>store Imagge  : </b></label>
		</div>
		<div class="col-md-8">
			  @foreach(explode(',',$storelist->store_image)  as $images)
               <img src="{{ URL('public/images/store') }}/{{ $images }}" alt="" height="50px" width="50px">
               @endforeach
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="store_name"><b>store Code : </b></label>
		</div>
		<div class="col-md-8">
			{{ $storelist->store_code }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="store_name"><b>store Name  : </b></label>
		</div>
		<div class="col-md-8">
			{{ $storelist->store_name }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="category"><b>category : </b></label>
		</div>
		<div class="col-md-8">
			{{ $storelist->category }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="mobile"><b>mobile : </b></label>
		</div>
		<div class="col-md-8">
			{{ $storelist->mobile }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label for="email"><b>email : </b></label>
		</div>
		<div class="col-md-8">
			{{ $storelist->email }}
		</div>
	</div>
	<hr>
		<div class="row">
			<div class="col-md-4">
				<label for="website"><b>Website : </b></label>
			</div>
			<div class="col-md-8">
				{{ $storelist->website }}
			</div>
		</div>
		<hr>

	<div class="row">
		<div class="col-md-4">
			<label for="address"><b>Address : </b></label>
		</div>
		<div class="col-md-8">
		   {{ $storelist->address }}
		</div>
	</div>
	<hr>
  
	


<script>
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script> 