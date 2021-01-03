@component('mail::message')
# Formulario de contacto <br>

<strong>Nombre:</strong> {{ $data['nombre'] }} <br>

<strong>Correo electrónico:</strong> {{ $data['correo'] }} <br>

<strong>Teléfono:</strong> {{ $data['telefono'] }} <br>

<strong>Mensaje:</strong> <br>

{{ $data['mensaje'] }}

<br>
@endcomponent