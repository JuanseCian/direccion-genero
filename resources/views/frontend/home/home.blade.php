@extends('frontend.layouts.front')

@section('title', 'Inicio')

@section('content')
<div class="card card-soft p-4">
    <h3>Bienvenido</h3>
    <p>Sistema de la Dirección de Género</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
</script>
@endif
@endsection