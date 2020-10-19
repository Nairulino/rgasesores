@if(session('success'))
  <div class="alert alert-success" role="alert">
    {{session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if(session('warning'))
  <div class="alert alert-warning" role="alert">
    {{session('warning')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if(session('failure'))
  <div class="alert alert-danger" role="alert">
    {{session('failure')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if (session('alert'))
  <div class="alert alert-success alert-rounded"> <img src="{{Storage::url(Auth::user()->img)}}" width="30" class="rounded-circle" alt="img"> {{ session('alert') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  </div>
@endif
