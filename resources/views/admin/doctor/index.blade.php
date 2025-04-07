@extends('admin.layout.app')
@section('title')
    <span>Doctors</span>
@endsection
@section('btn')
    <a href="{{ route('admin.doctor.add') }}" class="btn btn-primary">Add Doctor</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->title }}</td>
                    <td>{{ $doctor->position }}</td>
                    <td>
                        <a href="{{ route('admin.doctor.edit', ['doctor_id' => $doctor->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.doctor.del', ['doctor_id' => $doctor->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
@endsection
