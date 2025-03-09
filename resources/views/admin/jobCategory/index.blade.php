@extends('admin.layout.app')
@section('title')
    <span>Job Categories</span>
@endsection
@section('btn')
    <a href="{{ route('admin.jobCategory.add') }}" class="btn btn-primary">Add</a>
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
            @foreach ($jobcategories as $category)
                <tr>
                    <td>{{ $category->title }}</td>
                    <td>
                        <a href="{{ route('admin.jobCategory.edit', ['jobCategory_id' => $category->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.jobCategory.del', ['jobCategory_id' => $category->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.jobCategory.job.index', ['jobCategory_id' => $category->id]) }}"
                            class="btn btn-info btn-sm">
                            Manage Jobs
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
