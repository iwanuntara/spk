<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spk;
use App\Models\Area;
use App\Models\Mesin;
use DataTables;
use Alert;
use Auth;

class SpkController extends Controller
{
    public function index() {
        $title = 'Data SPK';
        $subtitle = 'List Data SPK';
        return view('spk.index', compact('title', 'subtitle'));
    }
    public function yajra() {
        $spk = Spk::select([
            'id', 'nomor', 'area_id', 'mesin_id', 'tanggal', 'shift', 'status'])
            ->with(['areas', 'mesins'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($spk)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            $userRole = auth()->user()->role;
            if ($userRole == 'staff') {
                return '<center><a href="spk/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a></center>';
            } elseif ($userRole == 'tehnik' || $userRole == 'qa') {
                return '<center><a href="spk/edit/'.$rows->id.'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></center>';
            }
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data SPK';
        $subtitle = 'Add Data SPK';
        $area = Area::latest()->get();
        $mesin = Mesin::latest()->get();
        return view('spk.add', compact('title', 'subtitle', 'area', 'mesin'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'area_id'=>'required',
    		'mesin_id'=>'required',
    		'jam'=>'required',
    		'shift'=>'required',
    		'permasalahan'=>'required',
         ]);

         $user = Auth::user();
         $lastNomorDisnaker = Spk::max('nomor');
         $lastNumber = intval(substr($lastNomorDisnaker,  0, strpos($lastNomorDisnaker, ' -')));
         $newNumber = $lastNumber + 1;
         $bulanRomawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'][date('n')];
         $newNomorSPK = str_pad($newNumber, 5, '0', STR_PAD_LEFT) . " - FORM/SPK/{$bulanRomawi}/" . date('Y');
         Spk::insert([
            'nomor'=> $newNomorSPK,
            'area_id'=> $request->area_id,
            'mesin_id'=> $request->mesin_id,
            'jam'=> $request->jam,
            'shift'=> $request->shift,
            'kategori'=> is_array($request->kategori) ? implode(',', $request->kategori) : $request->kategori,
            'tanggal'=> now(),
            'permasalahan'=> $request->permasalahan,
            'diserahkan' => $user->id,
            'status' => '1'
         ]);
         Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('spk');
    }
    public function view($id)
    {
        $title = 'Data SPK ';
        $subtitle = 'View Data SPK';
        $spk = Spk::where('id', $id)
        ->with(['areas', 'mesins'])
        ->first();
        return view('spk.view', compact('title', 'subtitle', 'spk'));
    }
    public function edit($id)
    {
        $title = 'Data SPK ';
        $subtitle = 'Edit Data SPK';
        $spk = Spk::where('id', $id)
        ->with(['areas', 'mesins', 'users'])
        ->first();
        return view('spk.edit', compact('title', 'subtitle', 'spk'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'no_mesin'=>'required',
    		'nama_mesin'=>'required',
         ]);
            Spk::where('id',$id)->update([
                'no_mesin'=> $request->no_mesin,
                'nama_mesin'=> $request->nama_mesin,
                'riwayat_mesin'=> $request->riwayat_mesin
            ]);
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('spk');
            }
        }
}
