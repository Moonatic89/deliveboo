<tr>
    <td class="header">
        <a href="http://127.0.0.1:8000/" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://i.imgur.com/QTBujiB.png" class="logo" alt="Deliveboo Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
