@extends('frontend.layouts.front')

@section('title','Reporte de Intervenciones')

@section('content')

<div class="card card-soft p-4 shadow-sm border-0">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 style="color:#5651A0;">
<i class="bi bi-activity"></i>
Reporte de Intervenciones
</h2>

<button onclick="window.print()" class="btn btn-light border">
<i class="bi bi-printer"></i> Imprimir
</button>

</div>

{{-- FILTRO --}}

<form method="GET" class="row g-3 mb-4">

<div class="col-md-4">
<label>Desde</label>
<input type="date" name="desde" value="{{ $desde }}" class="form-control">
</div>

<div class="col-md-4">
<label>Hasta</label>
<input type="date" name="hasta" value="{{ $hasta }}" class="form-control">
</div>

<div class="col-md-4 d-flex align-items-end">
<button class="btn text-white w-100" style="background:#5651A0;">
Aplicar filtro
</button>
</div>

</form>

{{-- TOTAL --}}

<div class="card border-0 shadow-sm mb-4 text-center p-4" style="background:#5651A0;">

<h6 class="text-white">
TOTAL DE INTERVENCIONES
</h6>

<h1 class="text-white display-4">
{{ $totalIntervenciones }}
</h1>

</div>

{{-- POR AREA --}}

<div class="row mb-4">

@foreach($porArea as $area)

<div class="col-md-4">

<div class="card border-0 shadow-sm p-3 text-center">

<h6 class="text-muted">
{{ strtoupper($area->area) }}
</h6>

<h3 class="fw-bold">
{{ $area->total }}
</h3>

</div>

</div>

@endforeach

</div>

{{-- TABLA POR TIPO --}}

<div class="card shadow-sm border-0 mb-4">

<div class="card-header bg-light">
<strong>Intervenciones por Tipo</strong>
</div>

<table class="table mb-0">

<thead>
<tr>
<th>Tipo</th>
<th>Total</th>
</tr>
</thead>

<tbody>

@foreach($porTipo as $tipo)

<tr>
<td>{{ $tipo->nombre }}</td>
<td>{{ $tipo->total }}</td>
</tr>

@endforeach

</tbody>

</table>

</div>

{{-- GRAFICO --}}

<div class="card border-0 shadow-sm p-4 text-center">

<div style="max-width:600px;margin:auto;height:350px;">
<canvas id="graficoIntervenciones"></canvas>
</div>

<div class="mt-3">

<button class="btn btn-sm btn-outline-secondary me-2"
onclick="cambiarTipo('bar')">
Histograma
</button>

<button class="btn btn-sm btn-outline-secondary"
onclick="cambiarTipo('doughnut')">
Donut
</button>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

let tipoActual='bar'
let grafico

const labels={!! json_encode($porTipo->pluck('nombre')) !!}
const datos={!! json_encode($porTipo->pluck('total')) !!}

const ctx=document.getElementById('graficoIntervenciones').getContext('2d')

function crearGrafico(tipo){

if(grafico){grafico.destroy()}

grafico=new Chart(ctx,{
type:tipo,
data:{
labels:labels,
datasets:[{
label:'Intervenciones',
data:datos,
backgroundColor:[
'#5651A0',
'#7A74C9',
'#9C97E5',
'#C5C2F5',
'#3f3a8a'
]
}]
},
options:{
responsive:true,
plugins:{
legend:{
display:tipo==='doughnut',
position:'bottom'
}
}
}
})

}

function cambiarTipo(tipo){
tipoActual=tipo
crearGrafico(tipoActual)
}

crearGrafico(tipoActual)

</script>

@endsection