<ul class="footer-links">
    @foreach ($specialities as $speciality)
        <li> <a href="#">{{ $speciality->title }}</a> </li>
    @endforeach
    @if ($specialities->count() > 6)
        <li><a href="#">More</a></li>
    @endif
</ul>
