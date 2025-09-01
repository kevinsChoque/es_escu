<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function actLogin()
    {
        // if (!Session::has('tecnical'))
        //     return redirect('/');
        // else
            return view('login/login');
    }
    public function actSigin(Request $r)
    {
        if($r->clave=='66666666')
            return response()->json(['estado' => true, 'message' => 'ok']);
        else
            return response()->json(['estado' => false, 'message' => 'Ingrese un usuario valido']);
    }
    public function actHome()
    {
        return view('admin.start');
    }

}
