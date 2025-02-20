@extends('admin.layout.app')
@section('title')
    <h4>
        <a href="">Specialties</a>
    </h4>
@endsection
@section('btn')
    <a href="{{ route('admin.speciality.add') }}" class="btn btn-primary">
        Add Speciality
    </a>
@endsection
@section('content')
this is speciality

@endsection
