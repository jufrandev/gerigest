@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ asset('assets/img/logo_300x300.png') }}" alt="GeriGest Logo" style="max-width: 150px;">
</div>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
