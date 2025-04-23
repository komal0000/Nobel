@extends('admin.layout.app')
@section('title')
    <span>Services</span>
@endsection
@section('btn')
    <a href="{{ route('admin.service.add') }}" class="btn btn-primary">Add</a>
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
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->title }}</td>
                    <td>
                        <a href="{{ route('admin.service.edit', ['service_id' => $service->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.service.del', ['service_id' => $service->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{ route('admin.service.faq.index', ['service_id' => $service->id]) }}"
                            class="btn btn-sm btn-info ">Manage FAQs</a>
                        <a href="{{ route('admin.service.benefit.index', ['service_id' => $service->id]) }}"
                            class="btn btn-sm btn-info">
                            Manage Benefits
                        </a>
                        @if ($service->has_package == 1)
                            <a href="{{ route('admin.service.package.type.index', ['service_id' => $service->id]) }}"
                                class="btn btn-sm btn-info ">Manage Packages</a>
                        @endif
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
