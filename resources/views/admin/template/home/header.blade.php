<ul class="drop-menu">
    @foreach ($specialities as $speciality)
        <li>
            <a href="{{ route('speciality.single',['speciality_id'=>$speciality->id]) }}" class="drop-item">{{ $speciality->title }}</a>
        </li>
    @endforeach
</ul>
