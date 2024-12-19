@extends('layouts.master')

@section('content')

 <div class="col-md-10">	
	<div class="card-body">
		<form role="form" id="category" method="POST" action="{{ url('area') }}">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Input Nama Area">
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="ket" class="form-control" id="ket" placeholder="Input Keterangan Area">
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Save Data</button>
			</div>
		</form>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$('#category').validate({ 
		rules: {
			name: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			name: {
				required: "Nama Area Harus di Isi",
				minlength: "Minimal 3 Karakter"
				}
			}
		});
</script>
@endsection