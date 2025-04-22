@extends('admin.layout.app')

@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <a href="{{ route('admin.service.package.type.index', ['service_id' => $packageType->service_id]) }}">Service Package Types</a> /
    <span>{{ $packageType->type }}</span>
@endsection
@section('btn')
    <a href="{{ route('admin.service.package.add', ['type_id' => $packageType->id]) }}" class="btn btn-primary">Add Package</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Price</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->service->title ?? 'N/A' }}</td>
                    <td>{{ $package->price }}</td>
                    <td>{{ $package->gender }}</td>
                    <td>{{ $package->age }}</td>
                    <td>
                        <a href="{{ route('admin.service.package.edit', ['package_id' => $package->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.service.package.del', ['package_id' => $package->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Service</th>
                <th>Price</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
