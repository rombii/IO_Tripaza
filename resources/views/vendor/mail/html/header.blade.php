<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Tripaza')
    <h1 style="font-size: 72px; color: #0d6efd;">Tripaza</h1>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
