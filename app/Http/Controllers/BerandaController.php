<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Spk;
use App\Models\Area;
use App\Models\Mesin;
use Auth;
class BerandaController extends Controller
{
    public function index() {
        $title = 'Beranda';
        $subtitle = 'Home';
        $user = User::all()->count();
        $spk = Spk::all()->count();
        $area = Area::all()->count();
        $mesin = Mesin::all()->count();
        return view('beranda.index',compact('title', 'subtitle', 'user', 'spk', 'area', 'mesin'));
    }

}
