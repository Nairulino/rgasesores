<?php

namespace App\Http\Controllers;

use Auth;
use App\Consultas;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Log;

class ConsultaController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->admin == 1)
            $consultas = DB::table('consultas')
                        ->join('users', 'consultas.id_user', '=', 'users.id')
                        ->select('consultas.*', 'users.name', 'users.img')
                        ->paginate(3);
        else
            $consultas = DB::table('consultas')
                        ->join('users', 'consultas.id_user', '=', 'users.id')
                        ->select('consultas.*', 'users.name', 'users.img')
                        ->where('id_user', '=', Auth::user()->id)
                        ->paginate(3);

        return view('pages.consulta', ['consultas' => $consultas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consulta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $files ='';
       
        if($request->hasFile('archivos')){
            foreach ( $request->archivos as $file)
            {
            $fileName = 'consulta-files-' . $file->getClientOriginalName();
            $path = $file->storeAs('public/documents/consultas', $fileName);
            $files = $files . $path . ";";
            }
        }
        
        if(Consultas::create([
            'title' => $request->titulo,
            'content' => $request->consulta, 
            'id_user' => $user_id,
            'files' => $files
        ])){
            return redirect()->route('consultas.index')->with('success','¡La consulta se ha creado correctamente!');
        } else {
            return redirect()->route('consultas.index')->with('failure','¡Error al crear la consulta!');
        }

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
        //
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
