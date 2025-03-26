<ul class="drop-menu">
    @foreach ($specialities as $speciality)
        <li>
            <a href="{{ route('speciality.single',['speciality_id'=>$speciality->id]) }}" class="drop-item">{{ $speciality->title }}</a>
        </li>
    @endforeach
    <li>
        <a href="{{route('speciality.index')}}" class="drop-item">View All Specialities</a>
    </li>
</ul>
