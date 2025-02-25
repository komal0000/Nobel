@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
    <span>{{$treatment->title}}</span> /
    <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $section->treatment_id]) }}">Sections</a> /
    <span>{{$section->title}}</span> /
    <span>Steps</span>
@endsection
@section('btn')
    <a href="{{ route('admin.treatment.section.step.add', ['section_id' => $section_id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>short Description</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($SectionSteps as $step)
                <tr>
                    <td>{{ $step->title }}</td>
                    <td>{{ $step->short_description }}</td>
                    <td>
                        <a href="{{ route('admin.treatment.section.step.edit', ['step_id' => $step->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.treatment.section.step.del', ['step_id' => $step->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>short Description</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
