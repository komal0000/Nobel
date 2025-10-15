@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    @if(!empty($logoCid))
        <img src="{{ $logoCid }}" class="logo" alt="{{ config('app.name') }}" style="max-height:60px;">
    @else
        {!! $slot !!}
    @endif
</a>
</td>
</tr>
