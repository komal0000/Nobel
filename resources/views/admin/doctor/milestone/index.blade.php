@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.doctor.index') }}">Doctor</a> /
    <span>Milestone</span>
@endsection
@section('css')
@section('css')
    <style>
        .update_input {
            border: none;
            padding: 0px;
            background-color: #F2F2F2;
        }

        .update_input:focus {
            background-color: #F2F2F2;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('admin.doctor.milestone.index', ['doctor_id' => $doctor->id]) }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="year">Year <span style="color: red;">*</span></label>
                <input type="number" name="year" id="year" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
                <label for="description">Short Description (~5 words) <span style="color: red;">*</span></label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    @if ($milestones !== null)

        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Short Description</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($milestones as $milestone)
                    <tr id="tr_{{ $milestone->id }}">
                        <td>
                            <input type="number" name="year" id="year_{{ $milestone->id }}"
                                class="form-control update_input" value="{{ $milestone->year }}">
                        </td>
                        <td>
                            <input type="text" name="description" id="description_{{ $milestone->id }}"
                                class="form-control update_input" value="{{ $milestone->description }}">
                        </td>
                        <td>
                            <button onclick="editMilestone({{ $milestone->id }})"
                                class="btn btn-sm btn-warning">Update</button>
                            <button onclick="deleteMilestone({{ $milestone->id }})"
                                class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Year</th>
                    <th>Short Description</th>
                    <th>Manage</th>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
@section('js')
    <script>
        function editMilestone(id) {
            const year = $(`#year_${id}`).val();
            const description = $(`#description_${id}`).val();

            axios.post("{{ route('admin.doctor.milestone.edit', ['milestone_id' => 'ID']) }}".replace('ID', id), {
                    year: year,
                    description: description,
                })
                .then(res => {
                    if (res.data.success) {
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        }

        function deleteMilestone(id) {
            axios.get("{{ route('admin.doctor.milestone.del', ['milestone_id' => 'ID']) }}".replace('ID', id))
                .then(res => {
                    if (res.data.success) {
                        $(`#tr_${id}`).remove();
                    }
                })
                .catch(err => {

                })
        }
    </script>
@endsection
