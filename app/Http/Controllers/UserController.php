<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perusahaan;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function index() {
        $title = 'Data User';
        $subtitle = 'List User';
        return view('user.user_index', compact('title', 'subtitle'));
    }

    public function yajra() {
        $users = User::select([
            'id', 'name', 'email', 'role'])
            ->orderBy('id', 'DESC')
            ->get();
        $datatables = Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('action',function($rows){
            return '<center><a href="user/'.$rows->id.'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> 
            <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$rows->id.'" data-original-title="Delete" class="btn btn-sm btn-danger deleteData"><i class="fa fa-trash"></i> Delete</a></center>';
        });

        return $datatables
        ->make(true);
    }

    public function add()
    {
        $title = 'Data';
        $subtitle = 'Add User';
        return view('user.user_add', compact('title', 'subtitle'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
    		'password'=>'required',
    		'nama'=>'required',
    		'email'=>'required',
    		'role'=>'required',
         ]);
         User::insert([
            'password'=>Hash::make($request->password),
            'name'=>$request->nama,
            'email'=>$request->email,
            'role'=>$request->role,
         ]);
         if (response()->json('code' == '200')) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect('user');
         }
    }

    function profile() {
        $title = 'Data Profil';
        $subtitle = 'Data Profil User';
        $user = Auth::user();
        return view('user.view_profil', compact('title', 'subtitle', 'user'));
    }

    function password() {
        $title = 'Data Profil';
        $subtitle = 'Data Profil User';
        $user = Auth::user();
        return view('user.password_profil', compact('title', 'subtitle', 'user'));
    }

    public function sesiEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'code' => 200,
            'data' => $user,
            'Message' => 'Success Show Data',
        ]);
    }
    public function profileUser() {
        $user = Auth::user();
        return response()->json([
            'code' => 200,
            'data' => $user,
            'Message' => 'Success Show Data'
        ]);
    }

    public function changeProfil(Request $request) {
        $this->validate($request,[
            'nama' => 'required',
            'email' => 'required',
        ]);
        $user = Auth::user();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->save();
        Alert::success('Success ', 'Data Profil Anda Berhasil di Update');
        return redirect('profil');
    }

    public function changePassword(Request $request)
    {
        Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            return $value === $parameters[0];
        });
        $validator = Validator::make($request->all(), [
            'password' => 'required|password:' . $request->input('password_confirmation'),
            'password_confirmation' => 'required|same:password',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = Auth::user();
        // Verifikasi kata sandi saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            Alert::error('Maaf!!', 'Password Lama yang anda input salah');
            return redirect('profil');
        }
       
        $user->password = Hash::make($request->password);
        $user->save();
        Alert::success('Success ', 'Data Password Anda Berhasil di Update');
        return redirect('logout');
    }

    public function edit($id)
     {
        $title = 'Data User';
        $subtitle = 'Edit User';
        $user = User::where('id',$id)->first();

        return view('user.user_edit', compact('title', 'subtitle', 'user'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'nama'=>'required',
    		'email'=>'required',
    		'role'=>'required',
         ]);
        User::where('id',$id)->update([
            'name'=>$request->nama,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
        ]);
        if (response()->json('code' == '200')) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect('user');
         }
    }

    public function delete($id)
    {
        User::destroy($id);
        Alert::success('Delete', 'Data User Berhasil di Delete');
        return redirect('user');
    }

    public function RegistrasiPerusahaan(Request $request)  {
        $this->validate($request, [
    		'password'=> ['required','min:6'],
    		'name'=> 'required',
    		'email'=> ['required', 'unique:users'],
    		'perusahaan_id'=> ['required', 'unique:users'],
         ]);
        $perusahaan = Perusahaan::where('id', $request->perusahaan_id)->first();
        if (empty($perusahaan->no_hp)) {
            Alert::error('Error', 'Nomor Hp perusahaan masih Kosong, Silahkan Hubungi Admin');
            return redirect()->back();
        } if ($perusahaan->no_hp != $request->no_hp) {
            Alert::error('Error', 'Nomor Hp perusahaan tidak Valid, Silahkan masukan nomor yang sudah terdaftar');
            return redirect()->back();
        } else {
            User::insert([
                'password'=> Hash::make($request->password),
                'name'=> $request->name,
                'email'=> $request->email,
                'perusahaan_id'=> $request->perusahaan_id,
             ]);
             if (response()->json('code' == '200')) {
                Alert::success('Success', 'Pendaftaran Akun Berhasil, Silahkan Login');
                return redirect('register');
             }
        }
    }
}
