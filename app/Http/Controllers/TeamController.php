<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use DataTables;
use Alert;
use Carbon\Carbon;
use Image;

class TeamController extends Controller
{
    public function index() {
        $title = 'Data Team';
        $subtitle = 'List Team';
        return view('team.index', compact('title', 'subtitle'));
    }
    public function list()  {
        $product = Team::select([
            'id', 'nama','jabatan','image'])
            ->orderBy('id', 'DESC')
            ->get();
        $response=[
            'status'=>'success',
            'message'=>'List Data Team',
            'data' => $product,
        ];
        return response()->json($response, 200);
    }
    public function yajra() {
        $cate = Team::select([
            'id', 'nama','jabatan','image'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($cate)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center>
            <a href="team/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
            </center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data';
        $subtitle = 'Add team';
        return view('team.add', compact('title', 'subtitle'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'nama'=> 'required',
    		'jabatan'=> 'required',
    		'image'=> 'file|image|max:2048',
         ]);
         if ($request->hasFile('image')) {
         $picName = $request->file('image')->getClientOriginalExtension();
         $picName = Carbon::now()->timestamp. '.' . $picName;
         $uploadedImage = $request->image->move(public_path('assets/img/team/'), $picName);
         $destinationPath =  $picName;
         $img = Image::make($uploadedImage);
         $img->resize(505, 505);
         $img->save($uploadedImage);
         $team = new Team;
         $team->nama = $request->nama;
         $team->jabatan = $request->jabatan;
         $team->image = $destinationPath;
         $team->save();
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('team');
         }
        } else {
            Alert::error('error', 'Data Error ya');
            return redirect('team/add');
        }
    }
    public function edit($id)
    {
        $title = 'Data';
        $subtitle = 'Edit Team';
        $team = Team::where('id', $id)->first();
        return view('team.edit', compact('title', 'subtitle', 'team'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
    		'nama'=>'required',
    		'jabatan'=> 'required',
    		'image'=> 'file|image|max:2048',
         ]);
         if ($request->hasFile('image')) {
         $picName = $request->file('image')->getClientOriginalExtension();
         $picName = Carbon::now()->timestamp. '.' . $picName;
         $uploadedImage = $request->image->move(public_path('assets/img/team/'), $picName);
         $destinationPath =  $picName;
         $img = Image::make($uploadedImage);
         $img->resize(505, 505);
         $img->save($uploadedImage);

         $team =  Team::find($id);
         $team->nama = $request->nama;
         $team->jabatan = $request->jabatan;
         $oldFile = 'assets/img/team/'.$team->image;
         if (file_exists($oldFile)) {
            unlink($oldFile);
         }
         $team->image = $destinationPath;
         $team->save();
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect('team');
         }
        } else {
            $team =  Team::find($id);
            $team->nama = $request->nama;
            $team->jabatan = $request->jabatan;
            $team->save();
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('team');
             }
        }
    }
}
