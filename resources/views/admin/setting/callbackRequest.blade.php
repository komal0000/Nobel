@extends('admin.layout.app')
@section('title', 'Callback Requests')

@section('content')
    {{-- @dump($value) --}}
    <form action="{{ route('admin.setting.requestCallBack') }}" method="POST" onsubmit="saveData(event)">
        @csrf

        @if ($values !== null)
            <table id="datatable" class="table table-striped" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($values as $value)
                        <tr id="tr_{{ $value['id'] }}">
                            <td>
                                {{$value['details']['name']}}
                            </td>
                            <td>
                                {{$value['details']['phoneNumber']}}
                            </td>
                            <td>
                                {{$value['details']['email']}}
                            </td>
                            <td>
                                <button onclick="deleteCallback({{ $value['id'] }})" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Manage</th>
                    </tr>
                </tfoot>
            </table>
            <button class="btn btn-primary mt-3" type="submit">Save Changes</button>
        @endif
    </form>
@endsection
@section('js')
    <script>
        let callbackData = @json($values);
        function deleteCallback(id) {
            console.log("before delete: ", callbackData);
            
            const row = document.getElementById('tr_'+ id);
            if(row) {
                row.remove();
            }
            callbackData = callbackData.filter(item => item.id !== id);

            console.log("After Delete: ", callbackData);
            
        }

        function saveData(event) {
            event.preventDefault();
            axios.post("{{route('admin.setting.requestCallBack')}}", {
                data: callbackData,
                _token: '{{ csrf_token() }}'
            })
            .then(res => {
                location.reload();
            })
            .catch(error => {
                console.error('Failed to save the data: ', error)
            })
        }
    </script>
@endsection