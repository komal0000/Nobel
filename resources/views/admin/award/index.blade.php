@extends('admin.layout.app')
@section('title')
    <span>Awards</span>
@endsection
@section('css')
    <style>
        .update_input {
            border: none;
            padding: 0px;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('admin.award.index') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="year">Year</label>
                <input type="number" name="year" id="year" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
                <label for="short_description">Short Description</label>
                <input type="text" name="short_description" id="short_description" class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    @if ($awards !== null)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Short Description</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($awards as $award)
                    <tr id="tr_{{ $award->id }}">
                        <td>
                            <input type="number" name="year" id="year_{{ $award->id }}"
                                class="form-control update_input" value="{{ $award->year }}">
                        </td>
                        <td>
                            <input type="text" name="short_description" id="short_description_{{ $award->id }}"
                                class="form-control update_input" value="{{ $award->short_description }}">
                        </td>
                        <td>
                            <button onclick="editAward({{ $award->id }})" class="btn btn-sm btn-warning">Update</button>
                            <button onclick="deleteAward({{ $award->id }})" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
@section('js')
    <script>
        function editAward(id) {
            const year = $(`#year_${id}`).val();
            const short_description = $(`#short_description_${id}`).val();

            axios.post("{{ route('admin.award.edit', ['award_id' => 'ID']) }}".replace('ID', id), {
                    year: year,
                    short_description: short_description,
                })
                .then(res => {
                    if (res.data.success) {
                    alert('Award updated successfully');
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        }

        function deleteAward(id) {
            axios.get("{{ route('admin.award.del', ['award_id' => 'ID']) }}".replace('ID', id))
                .then(res => {
                    if (res.status === 200) {
                        $(`#tr_${id}`).remove();
                    }
                })
                .catch(err => {

                })
        }
    </script>
@endsection
