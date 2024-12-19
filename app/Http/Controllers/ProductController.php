<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use DataTables;
use Alert;
use Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index() {
        $title = 'Data Product';
        $subtitle = 'List Product';
        return view('product.index', compact('title', 'subtitle'));
    }
    public function list()  {
        $product = Product::select([
            'id', 'category_product_id','code', 'nama', 'image'])
            ->with('categories')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $response=[
            'status'=>'success',
            'message'=>'List Data Product',
            'data' => $product,
        ];
        return response()->json($response, 200);
    }
    public function view($id)
    {
        $product = Product::select([
            'id', 'category_product_id','code', 'nama', 'image'])
            ->with('categories')
            ->where('category_product_id', $id)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $response=[
            'status'=>'success',
            'message'=>'Detail Data Product',
            'data' => $product,
        ];
        return response()->json($response, 200);
    }
    public function detail($code)
    {
        $product = Product::select([
            'id', 'category_product_id','code', 'nama', 'image'])
            ->with('categories')
            ->where('code', $code)
            ->orderBy('id', 'DESC')
            ->first();
        $response=[
            'status'=>'success',
            'message'=>'Detail Data Product',
            'data' => $product,
        ];
        return response()->json($response, 200);
    }
    public function slide()  {
        $product = Product::select([
            'id', 'category_product_id','code', 'nama', 'image'])
            ->with('categories')
            ->orderBy('id', 'DESC')
            ->limit(15)->get();
        $response=[
            'status'=>'success',
            'message'=>'List Data Product',
            'data' => $product,
        ];
        return response()->json($response, 200);
    }
    public function yajra() {
        $cate = Product::select([
            'id', 'category_product_id','code', 'nama', 'image'])
            ->with('categories')
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($cate)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center>
                    <div class="dropdown">
                        <button class="btn btn-menu" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <li></li>
                            <li></li>
                            <li></li>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="product/'.$rows->code.'"><i class="fa fa-eye"></i>  View</a>
                            <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$rows->id.'" data-original-title="Delete" class="btn btn-sm btn-danger dropdown-item deleteData"><i class="fa fa-trash"></i>  Delete Data</a>
                        </div>
                    </div>
                </center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Tambah Data Product';
        $subtitle = 'Add product';
        $cat = Category::select(['id', 'nama'])->orderBy('id', 'DESC')->get();
        return view('product.product_add', compact('title', 'subtitle', 'cat'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'category'=>'required',
    		'nama'=>'required',
    		'detail'=>'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'mimes:mp4,mov,ogg,qt|max:5120',
         ]);
         $uuid = Str::random(17);
         $product = new Product;
         $product->category_product_id = $request->category;
         $product->code = $uuid;
         $product->nama = $request->nama;
         $product->slug = Str::slug($request->nama);
         $product->detail = $request->detail;
         $product->save();
       
         if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $imageResized = Image::make($image->getRealPath());
                $imageResized->resize(855, 605, function ($constraint) {
                    $constraint->aspectRatio(); 
                });

                $imageName = time() . '_' . $image->getClientOriginalName();
                $imageResized->save(public_path('storage/images/' . $imageName));

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/' . $imageName,
                ]);
            }
        }
        if ($request->hasfile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPath = $video->store('videos', 'public');
                ProductVideo::create([
                    'product_id' => $product->id,
                    'video_path' => $videoPath,
                ]);
            }
        }
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('product');
         }
    }
    public function edit($id)
    {
        $title = 'Data';
        $subtitle = 'Edit product';
        $cat = Category::select(['id', 'nama'])->orderBy('id','DESC')->get();
        $product = Product::where('code', $id)->with('categories', 'images')->first();
        return view('product.product_edit', compact('title', 'subtitle', 'product', 'cat'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
    		'category'=>'required',
    		'nama'=>'required',
    		'detail'=>'required',
         ]);
         if ($request->hasFile('image')) {
         $picName = $request->file('image')->getClientOriginalExtension();
         $picName = Carbon::now()->timestamp. '.' . $picName;
         $uploadedImage = $request->image->move(public_path('assets/img/product/'), $picName);
         $destinationPath =  $picName;
         $img = Image::make($uploadedImage);
         $img->resize(855, 505);
         $img->save($uploadedImage);

         $product =  Product::find($id);
         $product->category_product_id = $request->category;
         $product->nama = $request->nama;
         $product->slug = Str::slug($request->nama);
         $product->detail = $request->detail;
         $oldFile = 'assets/img/product/'.$product->image;
         if (file_exists($oldFile)) {
            unlink($oldFile);
         }
         $product->image = $destinationPath;
         $product->save();
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect('product');
         }
        } else {
            $product =  Product::find($id);
            $product->category_product_id = $request->category;
            $product->nama = $request->nama;
            $product->slug = Str::slug($request->nama);
            $product->detail = $request->detail;
            $product->save();
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('product');
             }
        }
    }
    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->delete();
            Alert::success('Success', 'Data Berhasil di Delete');
            return response()->json(['status' => 'success', 'message' => 'Data has been deleted successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data not found.']);
        }
    }

}
