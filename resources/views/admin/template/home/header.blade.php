<a href="#" class="navbar-link">
    {{$specialityLabel['specialitySingle'] ?? 'Speciality'}} <i class="bi bi-chevron-down"></i>
</a>
<ul class="drop-menu">
    @foreach ($specialities->take(5) as $speciality)
        <li>
            <a href="{{ route('speciality.single', $speciality->slug) }}" class="drop-item">{{ $speciality->title }}</a>
        </li>
    @endforeach
    <li>
        <a href="{{ route('speciality.index') }}" class="drop-item">View All {{$specialityLabel['specialityPlural'] ?? 'Specialities'}}</a>
    </li>
</ul>
