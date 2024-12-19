@extends('layouts.master')

@section('content')

			@if(auth()->user()->role == 'staff')
			<div class="tambah">
				<a href="spk/add" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Data SPK</a>
			</div>
			@endif
			<div class="card-body">
				<table class="table table-data table-border">
					<thead>
						<tr>
							<th>No </th>
							<th>Nomor </th>
							<th>Area </th>
							<th>Mesin </th>
							<th>Tanggal</th>
							<th>Shift</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
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
			var baseUrl = window.location.protocol === 'https:' ? "{{ secure_url('spk/yajra') }}" : "{{ url('spk/yajra') }}";
			$('.table-data').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				bAutoWidth:false,
				ajax: baseUrl,
				columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
	            {data: 'nomor', name: 'nomor'},
	            {data: 'areas.name', name: 'area'},
	            {data: 'mesins.nama_mesin', name: 'mesin'},
	            {data: 'tanggal', 
				render: function(data){
                    return moment(data).format('DD - MM - YYYY');
                }, name: 'tanggal'},
	            {data: 'shift', name: 'shift'},
	            {data: 'status',
				render: function(data){
                    if(data == '1'){
                        return '<span class="status-bar pengajuan">Proses Pengajuan</span>';
                    } else if(data == '2'){
                        return '<span class="status-bar selesai">Di Terima</span>';
                    } else if(data == '3'){
                        return '<span class="status-bar tolak">Di Kerjakan</span>';
                    } else if(data == '4'){
                        return '<span class="status-bar selesai"> Selesai</span>';
                    } else if(data == '5'){
                        return '<span class="status-bar setuju">Di Setujui</span>';
                    } else {
                        return ''; 
                    }
                },
				 name: 'status'},
	            {data: 'action', name: 'action'}
	            ]
	        });

			$('body').on('click','.deleteData',function(e){
				var id = $(this).data("id");
				console.log(id);
				if(confirm("Are You sure want to delete this Data !")){
					$.ajax({
						type: "DELETE",
						url: "product/"+ id,
						dataType: "JSON",
						data: {
							"_token": "{{ csrf_token() }}",
							"id": id 
						},
						success:function(response){
                            Swal.fire("success!", "Delete Data Berhasil", "success");
                            window.location.reload();
                        },
						error: function(xhr) {
						console.log(xhr.responseText); 
					}
					});
				}
			});
		})
	</script>

	@endsection