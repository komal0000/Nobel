@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.treatment.index') }}">Treatment</a> /
    <span>Sections</span>
@endsection
@section('btn')
    <a href="{{ route('admin.treatment.section.add', ['treatment_id' => $treatment_id]) }}" class="btn btn-primary">Add</a>
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
                                    <th>Style Type</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($treatmentSections as $section)
                                    <tr>
                                        <td>{{ $section->title }}</td>
                                        <td>{{ $section->style_type }}</td>
                                        <td>
                                            <a href="{{ route('admin.treatment.section.edit', ['section_id' => $section->id]) }}"
                                                class="btn btn-primary btn-sm ">Edit</a>
                                            <a href="{{ route('admin.treatment.section.del', ['section_id' => $section->id]) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                            <a href="{{ route('admin.treatment.section.step.index', ['section_id' => $section->id]) }}"
                                                class="btn btn-sm btn-success">Manage steps</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Style Type</th>
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
