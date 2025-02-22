@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Alinment</a> /
    <a href="{{route('admin.aliment.type.index',['aliment_id'=>$type->aliment_id])}}">Section Type</a> /
    <span>Section</span>
@endsection
@section('btn')
    <a href="{{ route('admin.aliment.type.section.add', ['type_id' => $type_id]) }}" class="btn btn-primary">Add</a>
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
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section->title }}</td>
                                        <td>
                                            <a href="{{ route('admin.aliment.type.section.edit', ['section_id' => $section->id]) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ route('admin.aliment.type.section.del', ['section_id' => $section->id]) }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
