@extends('pages.home')

@section('content-1')
<div class="card" id="personas-card">
    <div class="card-header" id="personas-header"> Personas físicas </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($personas as $user)
                <tr>
                    <th scope="row">{{$user->id}} </th>
                    <td>{{$user->name}} </td>
                    <td>{{$user->email}} </td>
                    <td><button disabled="disabled"></button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
            {{$personas->links()}}
    </div>
    
</div>

@endsection
