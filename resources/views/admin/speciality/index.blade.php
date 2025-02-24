@extends('admin.layout.app')
@section('title')
    <span>Specialties</span>
@endsection
@section('btn')
    <a href="{{ route('admin.speciality.add') }}" class="btn btn-primary">
        Add
    </a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Short Description</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($specialties as $speciality)
                <tr>
                    <td>{{ $speciality->title }}</td>
                    <td>{{ $speciality->short_description }}</td>
                    <td>
                        <a href="{{ route('admin.speciality.subspeciality.index', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-info btn-sm">
                            Sub
                        </a>
                        <a href="{{ route('admin.speciality.edit', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.speciality.del', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-info btn-sm">Manage Gallery </a>
                        <a href="{{ route('admin.aliment.add', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-sm btn-secondary">Manage Aliment</a>
                        <a href="{{ route('admin.treatment.add', ['speciality_id' => $speciality->id]) }}"
                            class="btn btn-sm btn-secondary">Manage Treatment</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Short Description</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
