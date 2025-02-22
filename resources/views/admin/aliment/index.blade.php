@extends('admin.layout.app')
@section('title')
    <span>Aliment</span>
@endsection
@section('btn')
    <a href="{{ route('admin.aliment.add') }}" class="btn btn-primary">Add</a>
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
                                    <th>Short Description</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aliments as $aliment)
                                    <tr>
                                        <td>{{ $aliment->title }}</td>
                                        <td>{{ $aliment->short_description }}</td>
                                        <td>
                                            <a href="{{ route('admin.aliment.edit', ['aliment_id' => $aliment->id]) }}"
                                                class="btn btn-primary btn-sm ">Edit</a>
                                            <a href="{{ route('admin.aliment.del', ['aliment_id' => $aliment->id]) }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
