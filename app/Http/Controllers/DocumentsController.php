<?php

namespace App\Http\Controllers;

use App\Documents;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Log;

class DocumentsController extends Controller
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
        $documents = DB::table('documents')
                        ->join('users', 'documents.id_user', '=', 'users.id')
                        ->select('documents.*','users.name')
                        ->paginate(7);

        return view('pages.documents', ['documents' => $documents]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updocument()
    {
        return view('pages.updocument');
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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $file = DB::select('select path from documents where id = ?', [$id]);

        return Storage::download($file[0]->path);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = DB::select('select path from documents where id = ?', [$id]);

        return Storage::response($file[0]->path);
    }

    /**
     * Display the list of file associated to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyDocs($user)
    {
        $id = Auth::user()->id;
        $documents = DB::table('documents')->where('id_user', $id)
                        ->paginate(7);

        return view('pages.mydocs', ['documents' => $documents]);
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
        
        $document = Documents::find($id);
        Storage::delete($document->path);
        $document->delete();
        Log::debug('El archivo se ha borrado correctamente');

        $documents = DB::table('documents')
                        ->join('users', 'documents.id_user', '=', 'users.id')
                        ->paginate(7);

        return view('pages.documents', ['documents' => $documents]);
    }
}
