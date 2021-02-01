<?php

namespace App\Http\Controllers;

use App\Sociedade;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SociedadController extends Controller
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
            'name' => ['string', 'max:255'],
            'phone' => ['integer','numeric', 'max:9'],
            'cif' => ['string','max:9']
        ]);
    }

    /**
     * Display the users registered.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $sociedades = DB::table('sociedades')->paginate(7);

        return view('admin.clientes.sociedades', ['sociedades' => $sociedades]);
    }

    /**
     * Crear una nueva sociedad
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Sociedade::create([
            'name' => $request->name,
            'cif' => $request->cif,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_user' => $request->id_user,
            'description' => $request->description,
            'user_name' => $request->user_name
        ])){
            return redirect()->route('sociedad')->with('success','¡La sociedad se ha registrado correctamente!');
        }else{
            return redirect()->route('sociedad');
        }
    }
}
