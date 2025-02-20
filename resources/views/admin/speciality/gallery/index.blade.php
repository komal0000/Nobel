@extends('admin.layout.app')
@section('title')
    <a href="{{route('admin.speciality.index')}}">Specialties</a> /
    <span>Gallery</span>
@endsection
@section('btn')
    <a href="{{ route('admin.speciality.gallery.add',['speciality_id'=>$speciality_id]) }}" class="btn btn-primary">
        Add Gallery
    </a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
          </div>
          <div class="card-body">
             <div class="custom-datatable-entries">
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
                            <td>{{$gallery->title}}</td>
                            <td>{{$gallery->description}}</td>
                            <td>
                                <a href="{{route('admin.speciality.gallery.edit',['gallery_id'=>$gallery->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('admin.speciality.gallery.del',['gallery_id'=>$gallery->id])}}" class="btn btn-danger btn-sm">Delete</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
