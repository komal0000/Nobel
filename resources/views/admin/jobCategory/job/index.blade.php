@extends('admin.layout.app')
@section('title')
   <a href="{{ route('admin.jobCategory.index') }}">Job Categories</a> /
   <span>Jobs</span>
@endsection
@section('btn')
   <a href="{{ route('admin.jobCategory.job.add', ['jobCategory_id' => $jobCategory->id]) }}"
      class="btn btn-primary">Add</a>
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
        @foreach ($jobs as $job)
         <tr>
           <td>{{ $job->title }}</td>
           <td>
            <a href="{{ route('admin.jobCategory.job.edit', ['job_id' => $job->id]) }}"
               class="btn btn-warning btn-sm ">Edit</a>

            <a href="{{ route('admin.jobCategory.job.del', ['job_id' => $job->id]) }}"
               class="btn btn-danger btn-sm">Delete</a>
               
            <a href="{{ route('admin.jobCategory.job.manage', ['job_id' => $job->id]) }}" class="btn btn-info btn-sm">
               Manage Job Requests
            </a>
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