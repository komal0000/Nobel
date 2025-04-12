@extends('admin.layout.app')
@section('title')
    <span>Policies</span>
@endsection
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
    <form action="{{ route('admin.policy.index') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
                <label for="description">Description <span style="color: red;">*</span></label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    @if ($policies !== null)

        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($policies as $policy)
                    <tr id="tr_{{ $policy->id }}">
                        <td>
                          {{ $policy->title }}
                        </td>

                        <td>
                           <a href="{{ route('admin.policy.edit',['policy_id'=>$policy->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button onclick="deletePolicy({{ $policy->id }})" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Manage</th>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
@section('js')
    <script>
        function editPolicy(id) {
            const title = $(`#title_${id}`).val();
            const description = $(`#description_${id}`).val();

            axios.post("{{ route('admin.policy.edit', ['policy_id' => 'ID']) }}".replace('ID', id), {
                    title: title,
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

        function deletePolicy(id) {
            axios.get("{{ route('admin.policy.del', ['policy_id' => 'ID']) }}".replace('ID', id))
                .then(res => {
                    if (res.data.success) {
                        $(`#tr_${id}`).remove();
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        }
    </script>
@endsection
