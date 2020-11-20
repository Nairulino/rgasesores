<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    
    /**
     * Get a validator for an update user request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'desc' => ['string', 'max:255']
        ]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = Auth::user()->id;

        $user = User::find($id);

        if($file = $request->file('profile-picture')){

            $ext = $file->getClientOriginalExtension();
            $name = "profile-img-" . $user->name . "-" . $user->id . "." .$ext;

            $user->img = $file->store('public/img/profile', ['name'=>$name]);

            $user->save();

            return redirect('profile')->with('alert', '¡Imagen de perfil actualizada!');
        }

        if($file = $request->file('documents')){

            $this->validator($request->all())->validate();

            $name = $file->getClientOriginalName();
            $path = $file->store('public/documents');
            $desc = $request->desc;

            DB::table('documents')->insert(
                ['id_user' => $id, 'desc_doc' => $desc, 'path' => $path, 'created_at' => Carbon::now()]
            );

            return redirect('documents')->with('success', '¡El documento se ha subido correctamente!');
        }

        return redirect('profile')->with('warning', 'No se ha seleccionado ninguna imagen.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if($file = $request->file('profile-picture')){

            $ext = $file->getClientOriginalExtension();
            $name = "profile-img-" . $user->name . "-" . $user->id . "." .$ext;

            $user->img = $file->store('public/img/profile', ['name'=>$name]);

            $user->save();

            return redirect()->route('edit', $user)->with('success', '¡Imagen de perfil actualizada!');
        }

        return redirect()->route('edit', $user)->with('warning', 'No se ha seleccionado ninguna imagen.' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
