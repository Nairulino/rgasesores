<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
            'name' => ['string', 'max:255'],
            'phone' => ['integer','numeric'],
            'description' => ['string','max:500']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users');
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
        //
    }

    /**
     * Búsqueda de usuarios 
     * 
     * @return output
     */
    public function search(Request $request){
        
        if($request->ajax()) {
          
            $data = User::where('name', 'LIKE', '%'.$request->user.'%')
                ->get();
           
            $html = '';
            $users = [];
           
            if (count($data)>0) {
              
                $html = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
              
                foreach ($data as $row){
                   
                    $html .= '<li class="list-group-item" id="users_list">'.$row->name.'<span id="id_user" style="display:none">'.$row->id.'</span></li>';
                    $users[] = ['name'=>$row->name, 'id_user'=>$row->id];
                }
              
                $html .= '</ul>';
            }
            else {
             
                $html .= '<li class="list-group-item">'.'No existen usuarios con ese nombre.'.'</li>';
            }

            $output = ['html'=>$html, 'users'=>$users];
           
            return $output;
        }
    }

    /**
     * Display the users registered.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $personas = DB::table('users')->paginate(7);

        return view('admin.clientes.personasfisicas', ['personas' => $personas]);
    }

    /**
     * Search the users registered.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchPersonasFisicas( Request $request )
    {
        
        $personas = DB::table('users')->where('name', 'like', '%'.$request->search.'%')->paginate(7);        

        return view('admin.clientes.personasfisicas', ['personas' => $personas]);
    }

    /**
     * Display the calendar.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCalendar()
    {
        return view('pages.calendar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.clientes.updateusers', ['user' => $user]);
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
        $this->validator($request->all())->validate();

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->description = $request->description;
        

        $user->save();

        return redirect()->route('personasfisicas')->with('success', 'El usuario ' .$user->name.' ha sido modificado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('personasfisicas')->with('warning', 'No puedes eliminarte a tí mismo.');
        }

        $user = User::find($id);
        if ($user != null) {
            $user->delete();
            return redirect()->route('personasfisicas')->with('success', 'El usuario '.$user->name.' ha sido eliminado con éxito.');
        }else{
            return redirect()->route('personasfisicas')->with('failure', 'El usuario '.$user->name.' no ha podido ser eliminado.');
        }
        
    }
}
