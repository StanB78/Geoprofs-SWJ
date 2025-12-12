

<x-app-layout>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f3f3f3;
            font-weight: bold;
        }

        .btn-accept {
            padding: 6px 12px;
            background: #4caf50;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
        }

        .btn-reject {
            padding: 6px 12px;
            background: #e53935;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .status-approved {
            color: #2e7d32;
            font-weight: bold;
        }

        .status-rejected {
            color: #c62828;
            font-weight: bold;
        }

        .status-pending {
            color: #ef6c00;
            font-weight: bold;
        }

    </style>


    <h1 style="font-size: 28px; font-weight: bold;">Meldingen</h1>


    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Rol</th>
            <th>Sector ID</th>
            <th>Soort</th>
            <th>Melding</th>
            <th>Startdatum</th>
            <th>Einddatum</th>
            <th>Datum aangemaakt</th>
            <th>Status</th>
            <th>Saldo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($meldingen as $melding)
            @if(Auth::user()?->rol == 3 || $melding->sectorID == Auth::user()?->sectorID)


            <tr>
                <td>{{ $melding->userID }}</td>
                <td>{{ $melding->rol }}</td>
                <td>{{$melding->user->sector->naam}}</td>
                <td>
                    @if($melding->soort == 1)
                        Ziek
                    @elseif($melding->soort == 2)
                        Verlof
                    @endif
                </td>
                <td>{{ $melding->melding }}</td>
                <td>{{ $melding->startdatum }}</td>
                <td>{{ $melding->einddatum }}</td>
                <td>{{ $melding->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    @if($melding->soort == 2)
                        @if(!$melding->status)
                            <a class="btn-accept" href="{{ route('melding.confirm', $melding->meldingID) }}"> ✔ Accepteer</a>
                            <a class="btn-reject" href="{{ route('melding.reject', $melding->meldingID) }}">✖ Afwijzen</a>
                        @endif

                            @if ($melding->status === 'approved')
                                <span class="status-approved">✔ Geaccepteerd</span>
                            @elseif ($melding->status === 'rejected')
                                <span class="status-rejected">✖ Afgewezen</span>
                            @else
                                <span class="status-pending">⏳ In afwachting</span>
                            @endif
                    @endif
                </td>
                <td>{{ $melding->leaveToken ?? '-' }}</td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}">Terug</a>

</x-app-layout>

