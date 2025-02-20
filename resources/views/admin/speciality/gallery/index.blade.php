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
    {{-- <div class="col-sm-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
          </div>
          <div class="card-body">
             <div class="custom-datatable-entries">
                <table id="datatable" class="table table-striped" data-toggle="data-table">

                </table>
             </div>
          </div>
       </div>
    </div>
 </div> --}}
@endsection
