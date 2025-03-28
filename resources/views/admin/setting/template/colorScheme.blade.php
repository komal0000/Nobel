<style>
    *{
        @foreach($data as $key => $value)
            --{{ $key }}: {!! $value !!};
        @endforeach
    }
</style>
