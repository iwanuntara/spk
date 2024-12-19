@extends('layouts.master')

@section('content')

			<div class="tambah">
				<a href="user/add" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Data User</a>
			</div>
			<div class="card-body">
				<table class="table table-data table-border">
					<thead>
						<tr>
							<th>#</th>
							<th>Name </th>
							<th>Email</th>
                            <th>Role</th>
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
			var baseUrl = window.location.protocol === 'https:' ? "{{ secure_url('user/yajra') }}" : "{{ url('user/yajra') }}";
			$('.table-data').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				bAutoWidth:false,
				ajax: baseUrl,
				columns: [
	            // or just disable search since it's not really searchable. just add searchable:false
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
	            {data: 'name', name: 'name'},
	            {data: 'email', name: 'email'},
	            {data: 'role', name: 'role'},
	            {data: 'action', name: 'action'}
	            ]
	        });

			$('body').on('click','.deleteData',function(e){
				var id = $(this).data("id");
				if(confirm("Are You sure want to delete this Data !")){
					$.ajax({
						type: "DELETE",
						url: "user/delete/"+ id,
						dataType: "JSON",
						data: {
							"_token": "{{ csrf_token() }}",
							"id": id 
						},
						error: function(xhr) {
						console.log(xhr.responseText); 
					}
					});
				}
				$(document).ajaxStop(function(){
					window.location.reload();
				});
			});
		})
	</script>

	@endsection