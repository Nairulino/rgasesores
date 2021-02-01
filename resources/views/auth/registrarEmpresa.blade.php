@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Registrar Empresa</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Control</a></li>
                <li class="active">Registrar Empresa</li>
            </ol>
        </div>
    </div>
    @include('partials.alerts')
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-xs-8">
            <div class="white-box">
                <form method='post' action="{{route('empresa.create')}}" class="form-horizontal form-material" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12">Nombre empresa</label>
                        <div class="col-md-12">
                            <input id="name" type="text" placeholder="Nombre de la empresa" name="name"
                                class="form-control form-control-line @error('name') is-invalid @enderror" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Cliente asociado a la empresa</label>
                        <div class="col-md-12">
                            <input id="user_name" type="text" placeholder="Introduzca el nombre del cliente"
                                class="form-control form-control-line" name="user_name" required> </div>
                        <div class="col-md-12" id="user_list"></div>  
                    </div>
                    <div class="form-group" style="display: none">
                        <div class="col-md-12">
                            <input id="id_user" type="text" class="form-control form-control-line" name="id_user"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input id="email" type="email" placeholder="Email"
                                class="form-control form-control-line @error('email') is-invalid @enderror" name="email"
                                required>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">CIF</label>
                        <div class="col-md-12">
                            <input id="cif" type="text" placeholder="Introduce el CIF de la sociedad" name="cif"
                                maxlength="9" class="form-control form-control-line  @error('cif') is-invalid @enderror"
                                required>

                            @error('cif')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Nº Teléfono</label>
                        <div class="col-md-12">
                            <input id="phone" type="text" placeholder="111333666" class="form-control form-control-line"
                                name="phone" maxlength="9" required> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Descripción</label>
                        <div class="col-md-12">
                            <textarea id="description" rows="5" class="form-control form-control-line"
                                name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="#">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">{{ __('Registrar empresa') }}</button>
                            </div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id_user = "";
    var name_user = "";
    $('#user_name').on('keypress',function (e) {
        if (e.key === "Enter") {
            var query = $('#user_name').val();
            $.ajax({                  
                url: "search/users",          
                type:"GET",              
                data:{
                    'user':query
                },
                
                success: function (data) {
                    $('#user_list').html("");
                    if(data.users[0] != undefined){
                        $('#user').val(data.users[0].name);
                        $('#id_user').val(data.users[0].id_user);
                    }
                }
            });
        }
    });
        
    $('#user_name').on('input',function (e) {
        var query = $('#user_name').val(); 

        $.ajax({                  
            url: "search/users",          
            type:"GET",              
            data:{'user':query},
            
            success:function (data) {
                $('#user_list').html(data.html);
            }
        });
    });

    $(document).on('click', '#users_list', function(){
        name_user = this.innerText;
        $('#user_name').val(name_user);
        id_user =  this.firstElementChild.innerText;
        $('#user_list').html("");
        $('#id_user').val(id_user);
    });
});
</script>

@endsection