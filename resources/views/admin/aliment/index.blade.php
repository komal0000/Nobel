@extends('admin.layout.app')

@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        <span>{{$speciality->title}}</span> /
        <span>Aliments</span>
    @else
        <span>Aliments</span>
    @endif
@endsection
@section('btn')
    @if ($speciality_id)
        <a href="{{ route('admin.aliment.add', ['speciality_id' => $speciality_id]) }}" class="btn btn-primary">Add</a>
    @else
        <a href="{{ route('admin.aliment.add') }}" class="btn btn-primary">Add</a>
    @endif
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
            @foreach ($aliments as $aliment)
                <tr>
                    <td>{{ $aliment->title }}</td>
                    <td>{{ $aliment->short_description }}</td>
                    <td>
                        <a href="{{ route('admin.aliment.edit', ['aliment_id' => $aliment->id ,'speciality_id'=>$speciality_id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.aliment.del', ['aliment_id' => $aliment->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.aliment.section.index', ['aliment_id' => $aliment->id ,'speciality_id'=>$speciality_id]) }}"
                            class="btn btn-info btn-sm">Manage Section</a>
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
