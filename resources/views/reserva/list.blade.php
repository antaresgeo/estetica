@extends('layouts.new.table')

@section('title', 'Reservas')

@section('theader', 'Tabla de Reservas')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Reservas</li>
</ol>
@endsection

@section('pre-card')
<div class="d-flex">
    <div class="mr-auto p-2"></div>
    <a href="{{ route('reserva.create') }}" class="btn btn-primary p-2">Nueva Reserva</a>
</div>
<br>
@endsection

@section('thead')
<tr>
    {{-- <th>id</th> --}}
    <th>Hora</th>
    <th>Acción</th>
</tr>
@endsection

@push('scripts')
<script>
$(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        ajax: '{!! route('reserva.list') !!}',
        columns: [
            { data: 'hora', name: 'hora' },
            // { data: 'cantidad', name: 'cantidad' },
            // { data: 'precio', name: 'precio' },
            { data: 'id', name: 'id', searchable: false, orderable: false, render: function ( data, type, row, meta ) {
                var edit = '{{ route('reserva.edit', ':id')}}'.replace(':id', data);
                var destroy = '{{ route('reserva.destroy', ':id') }}'.replace(':id', data);
                return '<a href="'+ edit +'" class="btn btn-warning" style="margin-right: 7px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="'+destroy+'" class="btn btn-danger" style="margin-right: 7px;"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }}
        ]
    });
});
</script>
@endpush

{{-- @section('tbody')
@foreach ($reservaes as $reserva)
<tr>
    <td>{{ $reserva->id }}</td>
    <td>{{ $reserva->nombre }}</td>
    <td>
        <a href="{{ route('reserva.edit', $reserva->id)}}" class="btn btn-warning">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        <a href="{{ route('reserva.destroy', $reserva->id) }}" class="btn btn-danger">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>
@endforeach
@endsection --}}

{{-- @section('footer')
{{ $reservaes->links() }}
@endsection --}}
