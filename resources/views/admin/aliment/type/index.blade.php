@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Alinment</a> /
    <span>Section Types</span>
@endsection
@section('btn')
    <a href="{{ route('admin.aliment.type.add', ['aliment_id' => $aliment_id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="custom-datatable-entries">
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
                                            <a href="{{ route('admin.aliment.type.edit', ['type_id' => $alimentType->id]) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ route('admin.aliment.type.del', ['type_id' => $alimentType->id]) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                            <a href="{{route('admin.aliment.type.section.index',['type_id' =>$alimentType->id])}}" class="btn btn-success btn-sm">Add section</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
