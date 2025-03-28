@extends('admin.layout.app')
@section('css')
    <style>
        .color-option input[type="radio"] {
            display: none;
        }

        .color-option label {
            display: block;
            padding: 15px;
            border-radius: 5px;
            color: white;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .color-option input[type="radio"]:checked+label {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
@endsection
@section('title')
    <Span>Color Scheme</Span>
@endsection
@section('content')
    <h5 class="mb-4">
        Choose any Color Scheme
    </h5>

    <form action="{{ route('admin.setting.colorscheme') }}" method="POST" onsubmit="event.preventDefault();saveData(this);">

        @csrf



        <div class="row">
            <div class="col-md-4 form-group">
                <input type="color" id="color-main" name="color-main" value="{{ $oldData['color-main'] ?? '#f04e30' }}">
                <label for="color-main">--color-main</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-dark-1" name="color-dark-1"
                    value="{{ $oldData['color-dark-1'] ?? '#d8462b' }}">
                <label for="color-dark-1">--color-dark-1</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-dark-2" name="color-dark-2"
                    value="{{ $oldData['color-dark-2'] ?? '#c03e26' }}">
                <label for="color-dark-2">--color-dark-2</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-dark-3" name="color-dark-3"
                    value="{{ $oldData['color-dark-3'] ?? '#a83722' }}">
                <label for="color-dark-3">--color-dark-3</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-dark-4" name="color-dark-4"
                    value="{{ $oldData['color-dark-4'] ?? '#902f1d' }}">
                <label for="color-dark-4">--color-dark-4</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-dark-5" name="color-dark-5"
                    value="{{ $oldData['color-dark-5'] ?? '#782718' }}">
                <label for="color-dark-5">--color-dark-5</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-light-1" name="color-light-1"
                    value="{{ $oldData['color-light-1'] ?? '#f26045' }}">
                <label for="color-light-1">--color-light-1</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-light-2" name="color-light-2"
                    value="{{ $oldData['color-light-2'] ?? '#f37159' }}">
                <label for="color-light-2">--color-light-2</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-light-3" name="color-light-3"
                    value="{{ $oldData['color-light-3'] ?? '#f5836e' }}">
                <label for="color-light-3">--color-light-3</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-light-4" name="color-light-4"
                    value="{{ $oldData['color-light-4'] ?? '#f69583' }}">
                <label for="color-light-4">--color-light-4</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-light-5" name="color-light-5"
                    value="{{ $oldData['color-light-5'] ?? '#f8a798' }}">
                <label for="color-light-5">--color-light-5</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-black" name="color-black"
                    value="{{ $oldData['color-black'] ?? '#000000' }}">
                <label for="color-black">--color-black</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-white" name="color-white"
                    value="{{ $oldData['color-white'] ?? '#ffffff' }}">
                <label for="color-white">--color-white</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-grey" name="color-grey" value="{{ $oldData['color-grey'] ?? '#58595B' }}">
                <label for="color-grey">--color-grey</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="color-dark-grey" name="color-dark-grey"
                    value="{{ $oldData['color-dark-grey'] ?? '#454545' }}">
                <label for="color-dark-grey">--color-dark-grey</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="secondary-white" name="secondary-white"
                    value="{{ $oldData['secondary-white'] ?? '#f6f6f6' }}">
                <label for="secondary-white">--secondary-white</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="border-color" name="border-color"
                    value="{{ $oldData['border-color'] ?? '#b7b7b7' }}">
                <label for="border-color">--border-color</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="color" id="border-color-light" name="border-color-light"
                    value="{{ $oldData['border-color-light'] ?? '#eee' }}">
                <label for="border-color-light">--border-color-light</label>
            </div>

            <div class="col-md-4 form-group">
                <input type="text" id="font-main" name="font-main"
                    value="{{ $oldData['font-main'] ?? '\"Montserrat\", sans-serif' }}">
                <label for="font-main">--font-main</label>
            </div>
            <div class="col-md-4 form-group">
                <button class="btn btn-primary">Save Data</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        function saveData(ele) {
            axios.post(ele.action, new FormData(ele))
                .then(res => {
                    if(res.data.success == true){
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        }
    </script>
@endsection
