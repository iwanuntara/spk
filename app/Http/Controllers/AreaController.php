<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use DataTables;
use Alert;
class AreaController extends Controller
{
    public function index() {
        $title = 'Data Area';
        $subtitle = 'List Area';
        return view('area.index', compact('title', 'subtitle'));
    }
    public function yajra() {
        $cate = Area::select([
            'id', 'name', 'ket'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($cate)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center><a href="area/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a></center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data Area';
        $subtitle = 'Add Area';
        return view('area.area_add', compact('title', 'subtitle'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'name'=>'required',
         ]);
         Area::insert([
            'name'=> $request->name,
            'ket'=> $request->ket,
         ]);
         Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('area');
    }
    public function edit($id)
    {
        $title = 'Data Area ';
        $subtitle = 'Edit Area';
        $area = Area::where('id', $id)->first();
        return view('area.area_edit', compact('title', 'subtitle', 'area'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'name'=>'required',
         ]);
            Area::where('id',$id)->update([
                'name'=> $request->name,
                'ket'=> $request->ket
            ]);
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('area');
            }
        }
}
