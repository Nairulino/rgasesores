<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Mail;

class ContactFormController extends Controller
{
    public function store()
    {

        $data = request()->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required',
            'mensaje' => 'required'
        ]);

        Mail::to('antonio.95.29@gmail.com', 'RGAsesores')->send(new ContactFormMail($data));

        return redirect()->route('welcome');
    }
}
