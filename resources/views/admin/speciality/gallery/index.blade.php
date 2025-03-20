@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($parent_speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Specialties</span>/
        <span>Galleries</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        <span>{{ $speciality->title }}</span> /
        <span>Galleries</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.speciality.gallery.add', ['speciality_id' => $speciality->id, 'parent_speciality_id' => $parent_speciality_id]) }}"
        class="btn btn-primary">
        Add
    </a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($specialityGallery as $gallery)
                <tr>
                    <td>{{ $gallery->title }}</td>
                    <td>{{ $gallery->description }}</td>
                    <td>
                        <a href="{{ route('admin.speciality.gallery.edit', ['gallery_id' => $gallery->id, 'parent_speciality_id' => $parent_speciality_id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.speciality.gallery.del', ['gallery_id' => $gallery->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.speciality.gallery.item.index', ['gallery_id' => $gallery->id, 'parent_speciality_id' => $parent_speciality_id]) }}"
                            class="btn btn-sm btn-info">Gallery Items</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Options</th>
            </tr>
        </tfoot>
    </table>
@endsection
