@php
    $data =
        App\Helper::getSetting('contact') ??
        (object) [
            'email' => '',
        ];
    $phones =
        is_array($data->phone) || is_object($data->phone)
            ? (object) $data->phone
            : (object) [
                'phone1' => '',
                'phone2' => '',
                'phone3' => '',
                'phone4' => '',
            ];
@endphp
<ul class="drop-menu">
    <li>
        <a href="{{ route('contact') }}" class="drop-item">Contact Us</a>
    </li>
    @if($data->email)
        <li>
            <a href="mailto:{{ $data->email }}" class="drop-item">{{ $data->email }}</a>
        </li>
    @endif
   @foreach ($phones as $key => $phone)
      <li>
         <a href="tel:{{ $phone }}" class="drop-item">{{ $phone }}</a>
      </li>
   @endforeach
</ul>
