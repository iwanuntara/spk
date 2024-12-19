@extends('layouts.master')

@section('content')

 <div class="col-md-10">	
	<div class="card-body">
		<form role="form" id="about" method="post" action="{{ url('about/'.$about->id) }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="box-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="title" class="form-control" id="title" value="{{ $about->title }}" placeholder="Input title about">
				</div>
				<div class="form-group">
					<div class="pengurus">
						<?php if ($about->image === null) { ?>
							<img class="img-pengurus" src="{{ asset('public/assets/img/human_icon.png') }}" />
						<?php } else { ?>
							<img class="img-product" src="{{ asset('public/assets/img/about/'.$about->image) }}" />
						<?php } ?>
						<input type="hidden" name="oldImage" value="{{ $about->image }}"/>
					</div>
					<label>Ganti Image About Us</label>
					<input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/gif" onchange="loadFile(event)"/>
					<span>Upload Foto Max 2 Mb</span>
					<p><img id="output" width="200" /></p>
				</div>
				<div class="form-group">
					<label>Content</label>
					<textarea cols="30" rows="5" name="content" class="form-control" id="conten" placeholder="Input content">{{ $about->content }}</textarea>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Update Data</button>
			</div>
		</form>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$(function () {
		$('#conten').summernote()
	});
	$('#about').validate({ 
		rules: {
			title: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			title: {
				required: "Title About Us belum di Isi",
				minlength: "Minimal 3 Karakter"
				}
			}
	});
	var loadFile = function(event) {
		var image = document.getElementById('output');
		image.src = URL.createObjectURL(event.target.files[0]);
	}
</script>
@endsection