@extends('admin.layout.app')
@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents=\App\Helper::getSpecialityRoutes($speciality_id);
        @endphp
        @foreach ($parents as $parent)
        <a href="{{ route('admin.speciality.index',['speciality_id'=>$parent->id]) }}">{{$parent->title}}</a> /
        @endforeach
        <span>Treatments</span>
    @else
        <span>Treatments</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.treatment.add', ['speciality_id' => $speciality_id]) }}" class="btn btn-primary">Add</a>
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
            @foreach ($treatments as $treatment)
                <tr>
                    <td>{{ $treatment->title }}</td>
                    <td>
                        <a href="{{ route('admin.treatment.edit', ['treatment_id' => $treatment->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.treatment.del', ['treatment_id' => $treatment->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $treatment->id ,'speciality_id' => $speciality_id]) }}"
                            class="btn btn-info btn-sm">
                            Manage Sections
                        </a>
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
