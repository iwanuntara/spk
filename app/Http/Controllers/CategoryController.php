<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;
use Alert;

class CategoryController extends Controller
{
    public function index() {
        $title = 'Data Category Product';
        $subtitle = 'List Category Product';
        return view('category.index', compact('title', 'subtitle'));
    }
    public function list() {
        $contact = Category::select([
            'id', 'nama', 'note'])
            ->orderBy('id', 'DESC')
            ->get();
        $response=[
            'status'=>'success',
            'message'=>'List Data Contact',
            'data' => $contact,
        ];
        return response()->json($response, 200);
    }
    public function yajra() {
        $cate = Category::select([
            'id', 'nama', 'note'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($cate)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center><a href="category/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a></center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data';
        $subtitle = 'Add Category';
        return view('category.category_add', compact('title', 'subtitle'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'nama'=>'required',
         ]);
         Category::insert([
            'nama'=> $request->nama,
            'note'=> $request->note,
         ]);
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('category');
         }
    }
    public function edit($id)
    {
        $title = 'Data';
        $subtitle = 'Edit Category';
        $cat = Category::where('id', $id)->first();
        return view('category.category_edit', compact('title', 'subtitle', 'cat'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'nama'=>'required',
         ]);
            Category::where('id',$id)->update([
                'nama'=> $request->nama,
                'note'=> $request->note
            ]);
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('category');
            }
        }
}
