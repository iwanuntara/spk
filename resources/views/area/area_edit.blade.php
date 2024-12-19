@extends('layouts.master')

@section('content')

 <div class="col-md-10">	
	<div class="card-body">
		<form role="form" id="areas" method="post" action="{{ url('area/'.$area->id) }}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="box-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="name" class="form-control" id="name" value="{{ $area->name }}" placeholder="Input Nama Area">
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="ket" class="form-control" id="ket" value="{{ $area->ket }}" placeholder="Input Note jika ada">
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
	$('#areas').validate({ 
		rules: {
			name: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			nama: {
				required: "Nama Category Harus di Isi",
				minlength: "Minimal 3 Karakter"
				}
			}
	});
</script>
@endsection