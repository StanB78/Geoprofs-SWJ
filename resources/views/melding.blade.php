{{--comments--}}
{{--|| add soe when you can eccept somehting it has a nice button and
that you can see clearly see when somehtong is accepted --}}

{{--|| make it so the tabels look more orinized--}}

<x-app-layout>

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
                            <a href="{{ route('melding.confirm', $melding->meldingID    ) }}">Accepteer</a>
                            <a href="{{ route('melding.reject', $melding->meldingID) }}">Afwijzen</a>
                        @endif
                            @if ($melding->status === 'approved')
                                Geaccepteerd
                            @elseif ($melding->status === 'rejected')
                                Afgewezen
                            @else
                                In afwachting
                            @endif
                    @endif

                </td>

                <td>{{ $melding->leaveToken }}</td>
                <td>{{$melding->startdatum}}</td>
                <td>{{$melding->eidndatum}}</td>


            </tr>

        @endforeach
        </tbody>
    </table>

<a href="{{ route('dashboard') }}">terug</a>
    </x-app-layout>
