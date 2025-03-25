@extends('admin.layout.app')

@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['speciality_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Aliments</span>
    @else
        <span>Aliments</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.aliment.add', ['speciality_id' => $speciality_id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aliments as $aliment)
                <tr>
                    <td>{{ $aliment->title }}</td>
                    <td>
                        <a href="{{ route('admin.aliment.edit', ['aliment_id' => $aliment->id, 'speciality_id' => $speciality_id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.aliment.del', ['aliment_id' => $aliment->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
