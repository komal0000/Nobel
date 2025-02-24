@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
    <span>Sub Specialties</span>
@endsection
@section('btn')
    <a href="{{ route('admin.speciality.subspeciality.add',['speciality_id'=>$speciality_id]) }}" class="btn btn-primary">
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
            @foreach ($subspecialties as $subspeciality)
                <tr>
                    <td>{{ $subspeciality->title }}</td>
                    <td>{{ $subspeciality->short_description }}</td>
                    <td>
                        <a href="{{ route('admin.speciality.subspeciality.edit', ['subspeciality_id' => $subspeciality->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.speciality.subspeciality.del', ['subspeciality_id' => $subspeciality->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
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
