@extends('backend.layouts.app') 

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center text-white" 
             style="background:#4e4e4e; border-radius:8px 8px 0 0;">
            <h5 class="mb-0"><i class="bi bi-trash3 me-2"></i> Registros Eliminados (Últimos 30 días)</h5>
        </div>
        
        <div class="card-body bg-light">
            {{-- Nav Tabs --}}
            <ul class="nav nav-tabs mb-4" id="papeleraTab" role="tablist">
                <li class="nav-item">
                    {{-- Nota: Dejé data-bs-target y data-target por compatibilidad --}}
                    <button class="nav-link active btn-tab" data-bs-target="#tab-ive" data-target="#tab-ive" type="button">Área IVE</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn-tab" data-bs-target="#tab-genero" data-target="#tab-genero" type="button">Dirección Género</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn-tab" data-bs-target="#tab-masc" data-target="#tab-masc" type="button">Masculinidades</button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-ive">
                    @include('backend.papelera._tabla', ['registros' => $ive, 'tipo' => 'ive'])
                </div>
                <div class="tab-pane fade" id="tab-genero">
                    @include('backend.papelera._tabla', ['registros' => $genero, 'tipo' => 'genero'])
                </div>
                <div class="tab-pane fade" id="tab-masc">
                    @include('backend.papelera._tabla', ['registros' => $masculinidades, 'tipo' => 'masculinidades'])
                </div>
            </div>
        </div>

        {{-- Script infalible para forzar el cambio de pestañas --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const botones = document.querySelectorAll('.btn-tab');
                const paneles = document.querySelectorAll('.tab-pane');

                botones.forEach(boton => {
                    boton.addEventListener('click', function() {
                        // 1. Quitar 'active' de todos los botones
                        botones.forEach(b => b.classList.remove('active'));
                        // 2. Ocultar todos los paneles
                        paneles.forEach(p => p.classList.remove('show', 'active'));

                        // 3. Activar el botón clicado
                        this.classList.add('active');
                        
                        // 4. Mostrar el panel correspondiente
                        const targetId = this.getAttribute('data-target') || this.getAttribute('data-bs-target');
                        const panelDestino = document.querySelector(targetId);
                        if (panelDestino) {
                            panelDestino.classList.add('show', 'active');
                        }
                    });
                });
            });
        </script>
    </div>
</div>
@endsection