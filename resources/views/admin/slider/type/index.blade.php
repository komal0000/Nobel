@extends('admin.layout.app')
@section('title')
    <span>Slider Type</span>
@endsection
@section('content')
    <div class="shadow p-2 bg-white">
        <form action="{{ route('admin.slider.type.index') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="designated_for">Sider Designation</label>
                    <select name="designated_for" id="designated_for" class="form-control">
                        <option value="home">Home</option>
                        <option value="career">Career</option>
                        <option value="careerIntern">Career Internship</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
    <div class="shadow p-4 bg-white mt-3">
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliderTypes as $sliderType)
                    <tr>
                        <td>{{ ucfirst($sliderType->designated_for) }}</td>
                        <td>
                            <a href="{{ route('admin.slider.type.del', ['type_id' => $sliderType->id]) }}"
                                class="btn btn-sm btn-danger">Delete</a>
                            <a href="{{ route('admin.slider.index', ['type_id' => $sliderType->id]) }}"
                                class="btn btn-sm btn-info">Manage Slider</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
        </table>
    </div>
@endsection
