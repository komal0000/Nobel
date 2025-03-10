@extends('admin.layout.app')
@section('title')
    <span>Employee Testimonials</span>
@endsection
@section('btn')
    <a href="{{ route('admin.employeeTestimonial.add') }}" class="btn btn-primary">Add</a>
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
            @foreach ($EmployeeTestimonials as $testimonial)
                <tr>
                    <td>{{ $testimonial->title }}</td>
                    <td>
                        <a href="{{ route('admin.employeeTestimonial.edit', ['testimonial_id' => $testimonial->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.employeeTestimonial.del', ['testimonial_id' => $testimonial->id]) }}"
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
