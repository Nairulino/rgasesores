<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect, Response;

class FullCalendarEventMasterController extends Controller
{
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
        $insertArr = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Event::create($insertArr);
        return Response::json($event);
    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
        return Response::json($event);
    }

    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->id)->delete();
        return Response::json($event);
    }


    public function getLastID(Request $request)
    {
        if (request()->ajax()) {
            $data = DB::table('events')->orderBy('created_at', 'desc')->first();
            return Response::json($data);
        }
    }
}
