@extends('admin.layout.app')
@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['speciality_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Specialties</span> /
        <a href="{{ route('admin.treatment.index', ['speciality_id' => $speciality_id]) }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <span>Sections</span>
    @else
        <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <span>Sections</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.treatment.section.add', ['treatment_id' => $treatment->id, 'speciality_id' => $speciality_id]) }}"
        class="btn btn-primary">Add</a>
@endsection
@section('content')
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
                        <a href="{{ route('admin.treatment.section.edit', ['section_id' => $section->id, 'speciality_id' => $speciality_id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.treatment.section.del', ['section_id' => $section->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.treatment.section.step.index', ['section_id' => $section->id, 'speciality_id' => $speciality_id]) }}"
                            class="btn btn-sm btn-info">Manage steps</a>
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
@endsection
