@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Alinments</a> /
    <span>Sections</span>
@endsection
@section('btn')
    <a href="{{ route('admin.aliment.section.add', ['aliment_id' => $aliment_id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Section</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
                <tr>
                    <td>{{ $section->title }}</td>
                    @php
                        $type = DB::table('aliment_section_types')
                            ->where('id', $section->aliment_section_type_id)
                            ->first(['title']);
                    @endphp
                    <td>{{ $type->title }}</td>
                    <td>
                        <a href="{{ route('admin.aliment.section.edit', ['section_id' => $section->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.aliment.section.del', ['section_id' => $section->id]) }}"
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
