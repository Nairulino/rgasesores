<?php

namespace App\Http\Controllers;

use App\Event;
use Auth;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect, Response;
use Validator;

class FullCalendarEventMasterController extends Controller
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255']
        ]);
    }

    public function index()
    {
        if (request()->ajax()) {
            if(Auth::user()->admin == 1)
                $data = DB::table('events')->get();
            else
                $data = DB::table('events')->get()->where('name_user', '=', Auth::user()->name);
            return Response::json($data);
        }
        return view('pages.calendar');
    }

    public function create(Request $request)
    {
        if(Auth::user()->admin == 1)
        {
            $this->validator($request->all())->validate();

            $insertArr = [
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                'description'=>$request->description,
                'name_user'=>$request->name_user,
                'id_user'=>$request->id_user
            ];
            $event = Event::create($insertArr)->id;
            return Response::json($event);
        }else
            return abort(403, 'Esta acción no está permitida');        
    }

    public function update(Request $request)
    {
        if(Auth::user()->admin == 1)
        {
            $where = array('id' => $request->id);
            $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
            $event  = Event::where($where)->update($updateArr);
            return Response::json($event);
        }else
            return abort(403, 'Esta acción no está permitida');        
    }

    public function edit(Request $request)
    {
        if(Auth::user()->admin == 1)
        {
            $where = array('id' => $request->id);
            $editArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end, 
                        'name_user' => $request->name_user, 'id_user' => $request->id_user, 
                        'description' => $request->description];
            $event = Event::where($where)->update($editArr);
            return Response::json($event);
        }else
            return abort(403, 'Esta acción no está permitida');
       
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->admin == 1)
        {
            $event = Event::where('id', $request->id)->delete();
            return Response::json($event);
        }else 
            return abort(403, 'Esta acción no está permitida');
        
    }

}
