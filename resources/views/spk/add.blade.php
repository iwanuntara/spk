@extends('layouts.master')

@section('content')

 <div class="col-md-10">	
	<div class="card-body">
		<form role="form" id="product" method="POST" action="{{ url('spk') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="form-group">
					<label>Area/ Line</label>
					<select name="area_id" id="area_id" class="form-control">
						<option value=""> == Pilih Area == </option>
						@foreach ($area as $item)
						<option value="{{ $item->id }}"> {{ $item->name }} </option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Mesin</label>
					<select name="mesin_id" id="mesin_id" class="form-control">
						<option value=""> == Pilih Mesin == </option>
						@foreach ($mesin as $item)
						<option value="{{ $item->id }}"> {{ $item->nama_mesin }} </option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Jam</label>
					<input type="time" name="jam" class="form-control" id="jam" placeholder="Input Jam">
				</div>
				<div class="form-group">
					<label>Shift </label>
					<select name="shift" id="shift" class="form-control">
						<option value=""> === Pilih Shift === </option>
						<option value="1"> Shift 1</option>
						<option value="2"> Shift 2</option>
						<option value="3"> Shift 3</option>
					</select>
				</div>
				<div class="form-group">
					<label>Kategori</label><br/>
					<input type="checkbox" name="kategori[]" value="preventive"> Preventive &nbsp;
					<input type="checkbox" name="kategori[]" value="project"> Project &nbsp;
					<input type="checkbox" name="kategori[]" value="trial_product"> Trial Product &nbsp;
					<input type="checkbox" name="kategori[]" value="safety"> Safety &nbsp;
					<input type="checkbox" name="kategori[]" value="improvement"> Improvement &nbsp;
					<input type="checkbox" name="kategori[]" value="repair"> Repair &nbsp;
					<input type="checkbox" name="kategori[]" value="setting"> Setting &nbsp;
				</div>
				<div class="form-group">
					<label>Permasalahan</label>
					<textarea class="form-control" name="permasalahan" id="permasalahan" cols="30" rows="3"></textarea>
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
	$(document).ready(function(){
		$('#product').validate({ 
			rules: {
				nama: {
					required: true,
					minlength: 3
				},
				category: {
					required: true,
				},
				detail: {
					required: true,
				},
				fileInput: {
					filesize: 2097152 
				},
				video: {
					filesize: 5242880,
				}
			},
			messages: {
				nama: {
				required: "Nama Product belum di Isi",
				minlength: "Minimal 3 Karakter"
				},
				category: {
				required: "Category belum di Pilih"
				},
				detail: {
				required: "Detail belum di Isi"
				},
				video: {
				filesize: "Max Upload Video 5MB"
				} 
			}
		});
	});
</script>

@endsection