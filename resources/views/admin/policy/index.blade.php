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
                <label for="description">Description (~40 words)<span style="color: red;">*</span></label>
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
                        <td>{{ $policy->title }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $policy->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editModal{{ $policy->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $policy->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $policy->id }}">Edit Policy</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="title_{{ $policy->id }}">Title</label>
                                                <input type="text" class="form-control" id="title_{{ $policy->id }}" value="{{ $policy->title }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description_{{ $policy->id }}">Description (~40 words)</label>
                                                <textarea class="form-control" id="description_{{ $policy->id }}">{{ $policy->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="editPolicy({{ $policy->id }})">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.policy.del', ['policy_id' => $policy->id]) }}"
                                class="btn btn-sm btn-danger">Del</a>
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
                    if (res.data.status === 'success') {
                        $(`#editModal${id}`).modal('hide');
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
