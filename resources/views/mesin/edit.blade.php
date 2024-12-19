@extends('layouts.master')

@section('content')

 <div class="col-md-10">	
	<div class="card-body">
		<form role="form" id="slider" method="post" action="{{ url('mesin/'.$mesin->id) }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="box-body">
				<div class="form-group">
					<label>No Mesin</label>
					<input type="text" name="no_mesin" class="form-control" id="no_mesin" value="{{ $mesin->no_mesin }}" placeholder="Input No Mesin">
				</div>
				<div class="form-group">
					<label>Nama Mesin</label>
					<input type="text" name="nama_mesin" class="form-control" id="nama_mesin" value="{{ $mesin->nama_mesin }}" placeholder="Input Nama Mesin">
				</div>
				<div class="form-group">
					<label>Riwayat Mesin</label>
					<input type="text" name="riwayat_mesin" class="form-control" id="riwayat_mesin" value="{{ $mesin->riwayat_mesin }}" placeholder="Input riwayat Mesin">
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
	$('#slider').validate({ 
		rules: {
			nama: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			nama: {
				required: "Nama slider Harus di Isi",
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