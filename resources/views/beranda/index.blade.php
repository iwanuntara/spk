@extends('layouts.master')

@section('content')
		
		<div class="card-body">				
			<div class="row">
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
						<h3>{{ $user }}</h3>
							<p>Data User</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-stalker"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
						<h3>{{ $spk }}</h3>
							<p>Data SPK</p>
						</div>
						<div class="icon">
							<i class="ion ion-cash"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>{{ $area }}</h3>
							<p>Data Area</p>
						</div>
						<div class="icon">
							<i class="ion ion-calendar"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
						<h3>{{ $mesin }}</h3>
							<p>Data Mesin</p>
						</div>
						<div class="icon">
							<i class="ion ion-images"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>

@endsection
@section('scripts')
<script type="text/javascript">
</script>
@endsection
