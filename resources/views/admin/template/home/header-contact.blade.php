@php
    $data =
        App\Helper::getSetting('contact') ??
        (object) [
            'email' => '',
        ];

    $intData =
        App\Helper::getSetting('internationalContact') ??
        (object) [
            'phone' => '',
            'email' => '',
        ];
    $firstIntPhone = explode(',', $intData->phone)[0];
    $cleanFirstIntPhone = preg_replace('/[^\d+]/', '', trim($firstIntPhone));
    $phones =
        is_array($data->phone) || is_object($data->phone)
            ? (object) $data->phone
            : (object) [
                'phone1' => '',
                'phone2' => '',
                'phone3' => '',
                'phone4' => '',
            ];
            $firstPhone = explode(',', $phones->phone1)[0];
            $cleanFirstPhone = preg_replace('/[^\d+]/', '', trim($firstPhone));
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
      <li>
         <a href="tel:{{$cleanFirstPhone}}" class="drop-item">{{ $firstPhone }}</a>
      </li>
      @if ($intData->phone)
      <li>
        <a href="tel:{{$cleanFirstIntPhone}}" class="drop-item"><span class="para-wrap fw-semibold">Int:</span> {{ $firstIntPhone }}</a>
     </li>
      
      @endif
</ul>
