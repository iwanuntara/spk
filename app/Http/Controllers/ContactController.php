<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use DataTables;
use Alert;

class ContactController extends Controller
{
    public function index() {
        $title = 'Data Contact';
        $subtitle = 'List Contact';
        return view('contact.index', compact('title', 'subtitle'));
    }
    public function list() {
        $contact = Contact::OrderBy('id', 'DESC')->limit(1)->get();
        $response=[
            'status'=>'success',
            'message'=>'List Data Contact',
            'data' => $contact,
        ];
        return response()->json($response, 200);
    }
    public function yajra() {
        $cate = Contact::select([
            'id', 'alamat', 'email', 'telpon'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($cate)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center><a href="contact/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a></center>';
        });
        return $datatables
        ->make(true);
    }
    public function add()
    {
        $title = 'Data';
        $subtitle = 'Add contact';
        return view('contact.add', compact('title', 'subtitle'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
    		'alamat'=>'required',
            'email' => 'required|email',
            'telpon' => 'required'
         ]);
         Contact::insert([
            'alamat'=> $request->alamat,
            'email'=> $request->email,
            'telpon'=> $request->telpon
         ]);
         if (response()->json('code' == 200)) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('contact');
         }
    }
    public function edit($id)
    {
        $title = 'Data';
        $subtitle = 'Edit contact';
        $contact = Contact::where('id', $id)->first();
        return view('contact.edit', compact('title', 'subtitle', 'contact'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'alamat'=>'required',
            'email' => 'required|email',
            'telpon' => 'required'
         ]);
            Contact::where('id',$id)->update([
                'alamat'=> $request->alamat,
                'email'=> $request->email,
                'telpon'=> $request->telpon,
            ]);
            if (response()->json('code' == 200)) {
                Alert::success('Success', 'Data Berhasil di Update');
                return redirect('contact');
            }
        }
}
