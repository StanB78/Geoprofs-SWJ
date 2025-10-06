
<h1>Meldingen</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Soort</th>
            <th>Melding</th>
            <th>Datum</th>
        </tr>
        </thead>
        <tbody>
        @foreach($meldingen as $melding)
            <tr>
                <td>{{ $melding->userID }}</td>
                <td>
                    @if($melding->soort == 1)
                        Ziek
                    @elseif($melding->soort == 2)
                        Verlof
                    @endif
                <td>{{ $melding->melding }}</td>
                <td>{{ $melding->created_at->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

<a href="{{ route('dashboard') }}">terug</a>
