<?php

namespace App\Http\Controllers;

use App\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['admin']);
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'integer', 'numeric', 'max:9'],
            'cif' => ['required', 'string','max:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

     /**
     * Display the users registered.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $empresas = DB::table('empresas')->paginate(7);

        return view('admin.clientes.empresas', ['empresas' => $empresas]);
    }

    /**
     * Search the users registered.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchEmpresas(Request $request)
    {
        $empresas = DB::table('empresas')->where('name','like','%'.$request->search.'%')->paginate(7);

        return view('admin.clientes.empresas', ['empresas' => $empresas]);
    }

     /**
     * Crear una nueva empresa
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Empresa::create([
            'name' => $request->name,
            'cif' => $request->cif,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_user' => $request->id_user,
            'description' => $request->description,
            'user_name' => $request->user_name
        ])){
            return redirect()->route('empresa')->with('success', '¡La empresa se ha registrado correctamente!');
        }else{
            return redirect()->route('empresa');
        }

    }

}
