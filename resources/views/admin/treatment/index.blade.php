@extends('admin.layout.app')
@section('title')
    <span>Treatments</span>
@endsection
@section('btn')
    <a href="{{ route('admin.treatment.add') }}" class="btn btn-primary">Add</a>
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

@endsection
