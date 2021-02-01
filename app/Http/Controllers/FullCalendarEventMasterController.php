<?php

namespace App\Http\Controllers;

use App\Event;
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
        $this->middleware(['admin']);
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
            $data = DB::table('events')->get();
            return Response::json($data);
        }
        return view('pages.calendar');
    }

    public function create(Request $request)
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
    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
        return Response::json($event);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $editArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end, 
                    'name_user' => $request->name_user, 'id_user' => $request->id_user, 
                    'description' => $request->description];
        $event = Event::where($where)->update($editArr);
        return Response::json($event);
    }

    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->id)->delete();
        return Response::json($event);
    }

}
