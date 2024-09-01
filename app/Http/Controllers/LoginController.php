<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index ()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Si el usuario no está logeado, verificará que las credenciales de acceso
        //son correctas
        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        //Si es usuario se logea correctamente será redirecconado al muro o feed
        return redirect()->route('post.index', [$request->user()->username]);
    }

}
