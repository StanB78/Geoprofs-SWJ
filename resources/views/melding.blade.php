
<h1>Meldingen</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Soort</th>
            <th>Melding</th>
            <th>Datum</th>
            <th>status</th>
            <th>Saldo</th>
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
                <td>
                    @if($melding->soort == 2)
                        @if(!$melding->status)
                            <a href="{{ route('melding.confirm', $melding->meldingID) }}">accepteer</a>
                        @else
                            Geaccepteerd
                        @endif
                    @endif

                </td>

                <td>{{ $melding->leaveToken }}</td>


            </tr>

        @endforeach
        </tbody>
    </table>

<a href="{{ route('dashboard') }}">terug</a>
