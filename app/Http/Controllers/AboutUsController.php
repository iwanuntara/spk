<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use DataTables;
use Carbon\Carbon;
use Image;
use Alert;

class AboutUsController extends Controller
{
    public function index() {
        $title = 'Data About Us';
        $subtitle = 'List About Us';
        return view('about.index', compact('title', 'subtitle'));
    }
    public function list() {
        $contact = AboutUs::OrderBy('id', 'DESC')->limit(1)->get();
        $response=[
            'status'=>'success',
            'message'=>'List Data About Us',
            'data' => $contact,
        ];
        return response()->json($response, 200);
    }
    public function yajra() {
        $cate = AboutUs::select([
            'id', 'title','content','image'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($cate)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center>
            <a href="about/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
            </center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data';
        $subtitle = 'Add About Us';
        return view('about.add', compact('title', 'subtitle'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'title'=> 'required',
    		'image'=> 'file|image|max:2048',
         ]);
         if ($request->hasFile('image')) {
         $picName = $request->file('image')->getClientOriginalExtension();
         $picName = Carbon::now()->timestamp. '.' . $picName;
         $uploadedImage = $request->image->move(public_path('assets/img/about/'), $picName);
         $destinationPath =  $picName;
         $img = Image::make($uploadedImage);
         $img->resize(805, 505);
         $img->save($uploadedImage);
         $about = new AboutUs;
         $about->title = $request->title;
         $about->content = $request->content;
         $about->image = $destinationPath;
         $about->save();
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('about');
         }
        } else {
            Alert::error('error', 'Data Error ya');
            return redirect('about/add');
        }
    }
    public function edit($id)
    {
        $title = 'Data';
        $subtitle = 'Edit about';
        $about = AboutUs::where('id', $id)->first();
        return view('about.edit', compact('title', 'subtitle', 'about'));
    }
    public function update(Request $request, $id){
        $this->validate($request, [
    		'title'=>'required',
    		'image'=> 'file|image|max:2048',
         ]);
         if ($request->hasFile('image')) {
         $picName = $request->file('image')->getClientOriginalExtension();
         $picName = Carbon::now()->timestamp. '.' . $picName;
         $uploadedImage = $request->image->move(public_path('assets/img/about/'), $picName);
         $destinationPath =  $picName;
         $img = Image::make($uploadedImage);
         $img->resize(905, 805);
         $img->save($uploadedImage);

         $about =  AboutUs::find($id);
         $about->title = $request->title;
         $about->content = $request->content;
         $oldFile = 'assets/img/about/'.$about->image;
         if (file_exists($oldFile)) {
            unlink($oldFile);
         }
         $about->image = $destinationPath;
         $about->save();
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect('about');
         }
        } else {
            $about =  AboutUs::find($id);
            $about->title = $request->title;
            $about->content = $request->content;
            $about->save();
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('about');
             }
        }
    }
    
}
