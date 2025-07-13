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
    $firstPhone = explode(',', $intData->phone)[0];
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
   {{-- @foreach (array_slice((array)$phones, 0, 1) as $key => $phone) --}}
      <li>
         <div class="drop-item">{{ $phones->phone1 }}</div>
      </li>
      @if ($intData->phone)
      <li>
        <div class="drop-item"><span class="para-wrap fw-semibold">Int:</span> {{ $firstPhone }}</div>
     </li>
      
      @endif
</ul>
