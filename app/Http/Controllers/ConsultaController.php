<?php

namespace App\Http\Controllers;

use Auth;
use App\Consultas;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        if(Auth::user()->admin == 1){
            $consultas = DB::table('consultas')
                        ->join('users', 'consultas.id_user', '=', 'users.id')
                        ->select('consultas.*', 'users.name', 'users.img')
                        ->where('id_response', '=', 0)
                        ->paginate(3);

            foreach($consultas as $consulta){
                if($consulta->files != ''){
                    $this->formatFiles2($consulta);
                }
            }

            $consultas_response = DB::table('consultas')
                        ->join('users', 'consultas.id_user', '=', 'users.id')
                        ->select('consultas.*', 'users.name', 'users.img')
                        ->where('id_response', '<>', 0)
                        ->get();

            foreach($consultas_response as $consulta_response){
                if($consulta_response->files != ''){
                    $this->formatFiles2($consulta_response);
                }
            }

        Log::debug('Cuantas devuelve $consultas: ' . $consultas . ' - Cuantas devuelve $consultas_response: ' . count($consultas_response));
        }
        else
        {
            $consultas = DB::table('consultas')
                        ->join('users', 'consultas.id_user', '=', 'users.id')
                        ->select('consultas.*', 'users.name', 'users.img')
                        ->where('id_user', '=', Auth::user()->id)
                        ->paginate(3);

            foreach($consultas as $consulta){
                if($consulta->files != ''){
                    $this->formatFiles2($consulta);
                }
            }
            
            $consultas_response = DB::table('consultas')
                        ->join('users', 'consultas.id_user', '=', 'users.id')
                        ->select('consultas.*', 'users.name', 'users.img')
                        ->where('id_response', '<>', 0)
                        ->get();

            foreach($consultas_response as $consulta_response){
                if($consulta_response->files != ''){
                    $this->formatFiles2($consulta_response);
                }
            }
        }

        return view('pages.consulta', ['consultas' => $consultas, 'consultas_response' => $consultas_response]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = DB::table('users')->paginate(7);

        return view('consulta.create',['clientes' => $clientes]);
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
            if(count($request->archivos) <= 4){
                foreach ( $request->archivos as $file)
                {
                $fileName = 'consulta-files-' . $file->getClientOriginalName();
                $path = $file->storeAs('public/documents/consultas', $fileName);
                $files = $files . $path . ";";
                }
            }else{
                return redirect()->route('consultas.create')->with('warning','¡No se pueden adjuntar más de 4 archivos!');
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
     * Vista para responder a una consulta
     * 
     * @param int $id
     * @return view
     */
    public function answer($id)
    {
        $consulta = DB::table('consultas')
                        ->join('users', 'consultas.id_user', '=', 'users.id')
                        ->select('consultas.*', 'users.name', 'users.img')
                        ->where('consultas.id', '=', $id)
                        ->get();

        if($consulta[0]->files != ''){
            $this->formatFiles($consulta);
        }

        return view('consulta.answer', ['consulta' => $consulta]);
    }

    /**
     * Responder a una consulta
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function response(Request $request)
    {
        $user_id = Auth::user()->id;
        $files ='';
       
        if($request->hasFile('archivos')){
            if(count($request->archivos) <= 4){
                foreach ( $request->archivos as $file)
                {
                $fileName = 'consulta-response-files-' . $file->getClientOriginalName();
                $path = $file->storeAs('public/documents/consultas', $fileName);
                $files = $files . $path . ";";
                }
            }else{
                return redirect()->route('consultas.answer')->with('warning','¡No se pueden adjuntar más de 4 archivos!');
            }
        }

        $consulta = Consultas::find($request->id_response);
        
        if(Consultas::create([
            'title' => $request->titulo,
            'content' => $request->consulta, 
            'id_user' => $user_id,
            'id_response' => $request->id_response,
            'files' => $files
        ])){
            $consulta->read = true;
            $consulta->answered = true;
            $consulta->save();

            return redirect()->route('consultas.index')->with('success','¡La consulta se ha respondido correctamente!');
        } else {
            return redirect()->route('consultas.answer')->with('failure','¡Error al responder la consulta!');
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

    private function formatFiles($consulta){
        $files = $consulta[0]->files;
        $cont = 0;

        while($files != ''){
            $file[$cont] = Str::before($files, ';');
            $consulta[0]->files = $file;
            $files = Str::after($files, ';');
            $cont++;
        }
    }

    private function formatFiles2($consulta){
        $files = $consulta->files;
        $cont = 0;

        while($files != ''){
            $file[$cont] = Str::before($files, ';');
            $consulta->files = $file;
            $files = Str::after($files, ';');
            $cont++;
        }
    }
}
