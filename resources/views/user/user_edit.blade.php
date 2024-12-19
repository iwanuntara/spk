@extends('layouts.master')

@section('content')

	<div class="col-md-10">
		<div class="card-body">
			<form role="form" method="post" action="{{ url('user/'.$user->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="box-body">
					<div class="form-group">
						<label>Email</label>
					<input type="text" name="email" class="form-control" value="{{ $user->email }}" id="" placeholder="Input Email">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" id="" placeholder="Input Password">
					</div>
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" name="nama" class="form-control" value="{{ $user->name }}" id="" placeholder="Input Nama">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Role</label>
						<select class="form-control" name="role">
						<option value="{{ $user->role }}"> {{ $user->role }}</option>
							<option value=""> -- Pilih Role -- </option>
							<option value="admin"> Admin</option>
							<option value="staff"> Staff</option>
							<option value="tehnik"> Tehnik</option>
							<option value="qa"> Staff QA</option>
						</select>
					</div>
				</div>
				<?php
					$url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
				?>
				<!-- /.box-body -->
				<div class="box-footer">
					<a href="<?=$url; ?>" class="btn btn-danger"> Back</a>
					<button type="submit" class="btn btn-primary">Update Data </button>
				</div>
			</form>
		</div>
	</div>

@endsection

@section('scripts')