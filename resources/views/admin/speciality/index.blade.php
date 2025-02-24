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
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('admin.speciality.edit', ['speciality_id' => $speciality->id]) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('admin.speciality.del', ['speciality_id' => $speciality->id]) }}">Delete</a>
                                <a class="dropdown-item" href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id]) }}">Manage Gallery</a>
                                <a class="dropdown-item" href="{{ route('admin.aliment.add', ['speciality_id' => $speciality->id]) }}">Manage Aliment</a>
                                <a class="dropdown-item" href="{{ route('admin.treatment.add', ['speciality_id' => $speciality->id]) }}">Manage Treatment</a>
                            </div>
                        </div>
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
