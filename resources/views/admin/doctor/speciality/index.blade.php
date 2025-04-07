@extends('admin.layout.app')
@section('title')
    <span>Doctors</span>
@endsection
@section('btn')
    <a href="{{ route('admin.doctor.add') }}" class="btn btn-primary">Add Doctor</a>
@endsection
@section('content')
    <form action="{{ route('admin.doctor.speciality.index', ['doctor_id' => $doctor->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="speciality">Speciality</label>
                    <select name="speciality" id="speciality" class="form-control">
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary btn-sm">Add</button>
            </div>
        </div>
    </form>
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctorSpecialities as $speciality)
                <tr>
                    <td>{{ $speciality->title }}</td>
                    <td>
                        <a href="{{ route('admin.doctor.speciality.del', ['doctor_speciality_id' => $speciality->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
@endsection
