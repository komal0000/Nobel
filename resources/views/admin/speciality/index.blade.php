@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id == null)
        <span>Specialties</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($parent_speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent->id]) }}">{{ $parent->title }}</a>
        @endforeach
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.speciality.add', ['parent_speciality_id' => $parent_speciality_id]) }}" class="btn btn-primary">
        Add
    </a>
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
            @foreach ($specialties as $speciality)
                <tr>
                    <td>{{ $speciality->title }}</td>
                    <td>
                        <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $speciality->id]) }}"
                            class="btn btn-info btn-sm">
                            Sub
                        </a>
                        <a href="{{ route('admin.speciality.edit', ['speciality_id' => $speciality->id, 'parent_speciality_id' => $parent_speciality_id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.speciality.del', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id, 'parent_speciality_id' => $parent_speciality_id]) }}"
                            class="btn btn-info btn-sm">Manage Teams </a>
                        <a href="{{ route('admin.aliment.index', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-sm btn-secondary">Manage Aliment</a>
                        <a href="{{ route('admin.treatment.index', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-sm btn-secondary">Manage Treatment</a>
                        <a href="{{ route('admin.speciality.teamHead.index', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-sm btn-info">Team Head</a>
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
