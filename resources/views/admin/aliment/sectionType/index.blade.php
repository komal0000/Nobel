@extends('admin.layout.app')
@section('title')
    <span>Ailment Section Type</span>
@endsection
@section('btn')
    <a href="{{ route('admin.aliment.sectionType.add') }}" class="btn btn-primary">Add</a>
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
            @foreach ($alimentTypes as $alimentType)
                <tr>
                    <td>{{ $alimentType->title }}</td>
                    <td>
                        <a href="{{ route('admin.aliment.sectionType.edit', ['type_id' => $alimentType->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.aliment.sectionType.del', ['type_id' => $alimentType->id]) }}"
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
