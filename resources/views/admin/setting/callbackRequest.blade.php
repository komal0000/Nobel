@extends('admin.layout.app')
@section('title', 'Callback Requests')

@section('content')
    <form action="{{ route('admin.setting.requestCallBack') }}" method="POST">
        @csrf

        @if ($values !== null)
            <table id="datatable" class="table table-striped" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($values as $value)
                        <tr id="tr_{{ $value['id'] }}">
                            <td>
                                {{ $value['details']['name'] }}
                            </td>
                            <td>
                                {{ $value['details']['phoneNumber'] }}
                            </td>
                            <td>
                                {{ $value['details']['email'] }}
                            </td>
                            <td>
                              {{ $value['details']['message'] }}
                          </td>
                            <td>
                                <button onclick="deleteCallback({{ $value['id'] }})"
                                    class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Manage</th>
                    </tr>
                </tfoot>
            </table>
        @endif
    </form>
@endsection
@section('js')
    <script>
        let callbackData = @json($values);

        function deleteCallback(id) {
            console.log("before delete: ", callbackData);

            callbackData = callbackData.filter(item => item.id !== id);
            const row = document.getElementById('tr_' + id);
            
            axios.post("{{ route('admin.setting.requestCallBack') }}", {
                    data: callbackData,
                    _token: '{{ csrf_token() }}'
                })
                .then(res => {
                  if(res.status === 200) {
                     row.remove();
                     location.reload();
                  } else {
                     console.log('Error: ', res.data)
                     alert('Failed to delete the data. Try again later.')
                  }
                })
                .catch(error => {
                    console.error('Failed to save the data: ', error)
                })

        }
    </script>
@endsection
