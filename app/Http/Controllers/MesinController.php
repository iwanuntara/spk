<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesin;
use DataTables;
use Alert;

class MesinController extends Controller
{
    public function index() {
        $title = 'Data Mesin';
        $subtitle = 'List Data Mesin';
        return view('mesin.index', compact('title', 'subtitle'));
    }
    public function yajra() {
        $mesin = Mesin::select([
            'id', 'no_mesin', 'nama_mesin', 'riwayat_mesin'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($mesin)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center><a href="mesin/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a></center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data Mesin';
        $subtitle = 'Add data Mesin';
        return view('mesin.add', compact('title', 'subtitle'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'no_mesin'=>'required',
    		'nama_mesin'=>'required',
         ]);
         Mesin::insert([
            'no_mesin'=> $request->no_mesin,
            'nama_mesin'=> $request->nama_mesin,
            'riwayat_mesin'=> $request->riwayat_mesin,
         ]);
         Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('mesin');
    }
    public function edit($id)
    {
        $title = 'Data Mesin ';
        $subtitle = 'Edit Data Mesin';
        $mesin = Mesin::where('id', $id)->first();
        return view('mesin.edit', compact('title', 'subtitle', 'mesin'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'no_mesin'=>'required',
    		'nama_mesin'=>'required',
         ]);
            Mesin::where('id',$id)->update([
                'no_mesin'=> $request->no_mesin,
                'nama_mesin'=> $request->nama_mesin,
                'riwayat_mesin'=> $request->riwayat_mesin
            ]);
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('mesin');
            }
        }
}
