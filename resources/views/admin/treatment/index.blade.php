@extends('admin.layout.app')
@section('title')
    <span>Treatment</span>
@endsection
@section('btn')
    <a href="{{ route('admin.treatment.add') }}" class="btn btn-primary">Add</a>
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
                                @foreach ($treatments as $treatment)
                                    <tr>
                                        <td>{{ $treatment->title }}</td>
                                        <td>{{ $treatment->short_description }}</td>
                                        <td>
                                            <a href="{{ route('admin.treatment.edit', ['treatment_id' => $treatment->id]) }}"
                                                class="btn btn-primary btn-sm ">Edit</a>
                                            <a href="{{ route('admin.treatment.del', ['treatment_id' => $treatment->id]) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                            <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $treatment->id]) }}"
                                                class="btn btn-success btn-sm">
                                                Manage Sections
                                            </a>
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
