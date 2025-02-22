@extends('admin.layout.app')
@section('title')
    <a href="{{route('admin.treatment.index')}}">Treatment</a> /
    <a href="{{route('admin.treatment.section.index',['treatment_id' =>$section->treatment_id])}}">Sections</a> /
    <span>Steps</span>
@endsection
@section('btn')
<a href="{{route('admin.treatment.section.step.add',['section_id'=>$section_id])}}" class="btn btn-primary">Add</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="custom-datatable-entries">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>short Description</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SectionSteps as $step)
                                <tr>
                                    <td>{{ $step->title }}</td>
                                    <td>{{ $step->short_description}}</td>
                                    <td>
                                        <a href="{{ route('admin.treatment.section.step.edit', ['step_id' => $step->id]) }}"
                                            class="btn btn-primary btn-sm ">Edit</a>
                                        <a href="{{ route('admin.treatment.section.step.del', ['step_id' => $step->id]) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>short Description</th>
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
