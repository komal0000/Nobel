@extends('admin.layout.app')
@section('title')
    <span>Specialties</span>
@endsection
@section('btn')
    <a href="{{ route('admin.speciality.add') }}" class="btn btn-primary">
        Add Speciality
    </a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
             <div class="header-title">
                <h4 class="card-title">Bootstrap Datatables</h4>
             </div>
          </div>
          <div class="card-body">
             <div class="custom-datatable-entries">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                   <thead>
                      <tr>
                         <th>Title</th>
                         <th>Short Description</th>
                         <th>Manage</th>
                      </tr>
                   </thead>
                   <tbody>
                    @foreach ($specialties as $speciality)
                    <tr>
                        <td>{{$speciality->title}}</td>
                        <td>{{$speciality->short_description}}</td>
                        <td>
                            <a href="{{route('admin.speciality.edit', ['speciality_id' => $speciality->id])}}" class="btn btn-primary btn-sm me-2">Edit</a>
                            <a href="{{route('admin.speciality.del', ['speciality_id' => $speciality->id])}}" class="btn btn-danger btn-sm">Delete</a>
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
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
