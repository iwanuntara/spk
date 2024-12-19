@extends('layouts.master')

@section('content')

			
			<div class="card-body">
				<table class="table table-data table-border">
					<thead>
						<tr>
							<th>#</th>
							<th>Title </th>
							<th>Image</th>
							<th>Content</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>

<!-- Modal -->
<div class="modal modal-danger fade" id="modal-hapus">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Danger Modal</h4>
				</div>
				<div class="modal-body">
					<p>Are You Sure Delete Data This ?</p>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
					<form method="post" action="">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<button type="submit" class="btn btn-outline">Delete </button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	@endsection

	@section('scripts')

	<script type="text/javascript">
		$(document).ready(function(){
			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var baseUrl = window.location.protocol === 'https:' ? "{{ secure_url('about/yajra') }}" : "{{ url('about/yajra') }}";
			$('.table-data').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				bAutoWidth:false,
				ajax: baseUrl,
				columns: [
	            // or just disable search since it's not really searchable. just add searchable:false
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
	            {data: 'title', name: 'title'},
	            {data: 'image',
				"render": function (data) {
					return '<img src="public/assets/img/about/' + data + '" width="90" height="25"/>';
				},
				 name: 'image'},
	            {data: 'content',
				"render": function (data, type, row, meta) {
					if (type === 'display') {
						data = typeof data === 'string' && data.length > 70 ? data.substring(0, 70) + '...' : data;
					}
            		return data;
				},
				 name: 'content'},
	            {data: 'action', name: 'action'}
	            ]
	        });
		})
	</script>

	@endsection