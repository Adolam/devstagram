<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //Modificando el request
        $request->request->add(['username'=> Str::slug($request->username)]);

        $request->validate([
            'username'=> [
                'required',
                'unique:users,username,'.auth()->user()->id,
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil'
            ],
            'email' => [
                'required', 
                'unique:users,email,'.auth()->user()->id, 
                'email', 
                'max:60'
            ],
            
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $manager = new ImageManager(new Driver());
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->cover(1000, 1000);

            $imagenPath = public_path('perfiles/') . $nombreImagen;
            $imagenServidor->save($imagenPath);
        } 

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();


        //Redireccionar
        return redirect()->route('post.index', $usuario->username);
    }
}
