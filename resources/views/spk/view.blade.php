@extends('layouts.master')

@section('content')

 <div class="col-md-12">	
	<div class="card-body">
        <div class="subtitle border-solid mb-2">
            <div class="d-flex justify-content-between">
                <div class="row align-items-center status-progres">
                    <h6><b>Status :  &nbsp; </b> <?php if ($spk->status == '1') { ?>
                        <span class="status-bar pengajuan">Proses Pengajuan</span>
                    <?php } else if ($spk->status == '2') { ?>
                        <span class="status-bar selesai">SPK di Terima</span>
                    <?php } else if ($spk->status == '3') { ?>
                        <span class="status-bar tolak">SPK di Kerjakan</span>
                    <?php } else if ($spk->status == '4') { ?>
                        <span class="status-bar setuju">SPK Selesai</span>
                    <?php } else if ($spk->status == '5') { ?>
                        <span class="status-bar setuju">SPK di Setujui</span>
                    <?php } ?>    
                    </h6>
                </div>
            </div>
        </div>
        <div class="row head-kop">
            <div class="col-3 head-kiri">
                <div class="d-inline-block">
                    <img src="{{ asset('adminLTE3/dist/img/mayora-group.jpg')}}" class="icon-mayora" alt="mayora">
                </div>
                <div class="mt-2 ml-2">
                    <p>PT MAYORA INDAH DIVISI BISCUIT/ WAFER</p>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center mt-1">
                    <h3>SURAT PERINTAH KERJA<br/>(SPK)</h3>
                </div>
            </div>
            <div class="col-3 head-kanan d-flex align-items-center">
                <div class="sub-kanan">
                    <h5>{{ $spk->nomor }}</h5>
                </div>
            </div>
        </div>
			<div class="box-body">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Area/ Line</label>
                            <input type="text" name="area" class="form-control" id="area" value="{{ $spk->areas->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Mesin</label>
                            <input type="text" name="mesin" class="form-control" id="mesin" value="{{ $spk->mesins->nama_mesin }}" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" name="jam" class="form-control" id="jam" value="{{ $spk->tanggal }}" disabled>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Jam</label>
                                <input type="time" name="jam" class="form-control" id="jam" value="{{ $spk->jam }}" disabled>
                            </div>
                            <div class="col">
                                <label>Shift</label>
                                <input type="text" name="jam" class="form-control" id="jam" value="{{ $spk->shift }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
					<label>Kategori</label><br/>
					<input type="checkbox" name="kategori[]" value="preventive" 
						@if(strpos($spk->kategori, 'preventive') !== false) checked @endif> Preventive &nbsp;
					<input type="checkbox" name="kategori[]" value="project" 
						@if(strpos($spk->kategori, 'project') !== false) checked @endif> Project &nbsp;
					<input type="checkbox" name="kategori[]" value="trial_product" 
						@if(strpos($spk->kategori, 'trial_product') !== false) checked @endif> Trial Product &nbsp;
					<input type="checkbox" name="kategori[]" value="safety" 
						@if(strpos($spk->kategori, 'safety') !== false) checked @endif> Safety &nbsp;
					<input type="checkbox" name="kategori[]" value="improvement" 
						@if(strpos($spk->kategori, 'improvement') !== false) checked @endif> Improvement &nbsp;
					<input type="checkbox" name="kategori[]" value="repair" 
						@if(strpos($spk->kategori, 'repair') !== false) checked @endif> Repair &nbsp;
					<input type="checkbox" name="kategori[]" value="setting" 
						@if(strpos($spk->kategori, 'setting') !== false) checked @endif> Setting &nbsp;
				</div>
				<div class="form-group">
					<label>Permasalahan</label>
					<textarea class="form-control" name="permasalahan" id="permasalahan" cols="30" rows="3">{{ $spk->permasalahan }}</textarea>
				</div>
			</div>
			<div class="box-footer">
				<button type="button" class="btn btn-primary"> Kembali</button>
			</div>
	</div>
</div>

@endsection