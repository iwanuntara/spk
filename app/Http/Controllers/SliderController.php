<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use DataTables;
use Alert;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    public function index() {
        $title = 'Data Slider';
        $subtitle = 'List Slider';
        return view('slider.index', compact('title', 'subtitle'));
    }
    public function list()  {
        $product = Slider::select([
            'id', 'title','content','image'])
            ->orderBy('id', 'DESC')
            ->get();
        $response=[
            'status'=>'success',
            'message'=>'List Data Slider',
            'data' => $product,
        ];
        return response()->json($response, 200);
    }
    public function yajra() {
        $cate = Slider::select([
            'id', 'title','content','image'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($cate)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center>
            <a href="slider/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
            </center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data';
        $subtitle = 'Add slider';
        return view('slider.add', compact('title', 'subtitle'));
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
         $uploadedImage = $request->image->move(public_path('assets/img/slider/'), $picName);
         $destinationPath =  $picName;
         $img = Image::make($uploadedImage);
         $img->resize(1105, 505);
         $img->save($uploadedImage);
         $slider = new Slider;
         $slider->title = $request->title;
         $slider->content = $request->content;
         $slider->image = $destinationPath;
         $slider->save();
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('slider');
         }
        } else {
            Alert::error('error', 'Data Error ya');
            return redirect('slider/add');
        }
    }
    public function edit($id)
    {
        $title = 'Data';
        $subtitle = 'Edit slider';
        $slider = Slider::where('id', $id)->first();
        return view('slider.edit', compact('title', 'subtitle', 'slider'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
    		'title'=>'required',
    		'image'=>'required'
         ]);
         if ($request->hasFile('image')) {
         $picName = $request->file('image')->getClientOriginalExtension();
         $picName = Carbon::now()->timestamp. '.' . $picName;
         $uploadedImage = $request->image->move(public_path('assets/img/slider/'), $picName);
         $destinationPath =  $picName;
         $img = Image::make($uploadedImage);
         $img->resize(1105, 505);
         $img->save($uploadedImage);

         $slider =  Slider::find($id);
         $slider->title = $request->title;
         $slider->content = $request->content;
         $oldFile = 'assets/img/slider/'.$slider->image;
         if (file_exists($oldFile)) {
            unlink($oldFile);
         }
         $slider->image = $destinationPath;
         $slider->save();
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect('slider');
         }
        } else {
            $slider =  Slider::find($id);
            $slider->title = $request->title;
            $slider->content = $request->content;
            $slider->save();
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('slider');
             }
        }
    }
}
