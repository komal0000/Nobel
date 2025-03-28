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

    <form>
        <div class="color-scheme-options">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="default" value="default" {{ $colorScheme->value == 'default' ? 'checked' : '' }}>
                        <label for="default" style="background-color: #f04e30;">Default</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="dark-1" value="dark-1" {{ $colorScheme->value == 'dark-1' ? 'checked' : '' }}>
                        <label for="dark-1" style="background-color: #d8462b;">Dark 1</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="dark-2" value="dark-2"  {{ $colorScheme->value == 'dark-2' ? 'checked' : '' }}>
                        <label for="dark-2" style="background-color: #c03e26;">Dark 2</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="dark-3" value="dark-3" {{ $colorScheme->value == 'dark-3' ? 'checked' : '' }}>
                        <label for="dark-3" style="background-color: #a83722;">Dark 3</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="dark-4" value="dark-4" {{ $colorScheme == 'dark-4' ? 'checked' : '' }}>
                        <label for="dark-4" style="background-color: #902f1d;">Dark 4</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="dark-5" value="dark-5" {{ $colorScheme == 'dark-5' ? 'checked' : '' }}>
                        <label for="dark-5" style="background-color: #782718;">Dark 5</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="light-1" value="light-1" {{ $colorScheme == 'light-1' ? 'checked' : '' }}>
                        <label for="light-1" style="background-color: #f26045;">Light 1</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="light-2" value="light-2"{{ $colorScheme == 'light-2' ? 'checked' : '' }}>
                        <label for="light-2" style="background-color: #f37159;">Light 2</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="light-3" value="light-3"
                            {{ $colorScheme == 'light-3' ? 'checked' : '' }}>
                        <label for="light-3" style="background-color: #f5836e;">Light 3</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="light-4" value="light-4"
                            {{ $colorScheme == 'light-4' ? 'checked' : '' }}>
                        <label for="light-4" style="background-color: #f69583;">Light 4</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="color-option">
                        <input type="radio" name="color_scheme" id="light-5" value="light-5"
                            {{ $colorScheme == 'light-5' ? 'checked' : '' }}>
                        <label for="light-5" style="background-color: #f8a798;">Light 5</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3" onclick="SaveColorScheme()">Save Changes</button>
    </form>
@endsection
@section('js')
    <script>
        function SaveColorScheme() {
            event.preventDefault();
            var colorScheme = $('input[name="color_scheme"]:checked').val();
            var colorvalue = $('input[name="color_scheme"]:checked + label').css('background-color');

            console.log(colorvalue);
            var url = "{{ route('admin.setting.colorscheme') }}";
            axios.post(url, {
                    color_value: colorvalue,
                    _token: '{{ csrf_token() }}'
                })
                .then(function(res) {
                    if (res.data.success) {
                        location.reload();
                    } else {
                        alert('Error updating color scheme.');
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    alert('An error occurred while updating the color scheme.');
                });
        }
    </script>
@endsection
