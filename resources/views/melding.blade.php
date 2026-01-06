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

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Soort</th>
            <th>Melding</th>
            <th>Datum</th>
            <th>Status</th>
            <th>Saldo</th>
            <th>Startdatum</th>
            <th>Einddatum</th>
        </tr>
        </thead>

        <tbody>
        @foreach($meldingen as $melding)
            <tr>


                <td>{{ $melding->userID }}</td>


                <td>
                    {{ $melding->soort == 1 ? 'Ziek' : 'Verlof' }}
                </td>

                <td>{{ $melding->melding }}</td>

                <td>{{ $melding->created_at->format('d-m-Y H:i') }}</td>


                <td>
                    @if($melding->soort == 2)

                        @if(!$melding->status)
                            <a class="btn-accept"
                               href="{{ route('melding.confirm', $melding->meldingID) }}">
                                ✔ Accepteer
                            </a>

                            <a class="btn-reject"
                                href="{{ route('melding.reject.confirm', $melding->meldingID) }}">
                                ✖ Afwijzen
                            </a>

                        @endif

                        @if ($melding->status === 'approved')
                            <span class="status-approved">✔ Geaccepteerd</span>
                        @elseif ($melding->status === 'rejected')
                            <span class="status-rejected">✖ Afgewezen</span>
                        @else
                            <span class="status-pending">⏳ In afwachting</span>
                        @endif

                    @else
                        -
                    @endif
                </td>


                <td>{{ $melding->leaveToken }}</td>

                <td>{{ $melding->startdatum }}</td>

                <td>{{ $melding->einddatum }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>

    @if(\App\Http\Middleware\RoleCheck::check(3))
        <a href="{{ route('melding.pdf') }}"
           class="btn-accept"
           style="margin-bottom:10px; display:inline-block;">
            Download Verzuim log
        </a>
    @endif

    @if(\App\Http\Middleware\RoleCheck::check(3))
        <a href="{{ route('werknemers.pdf') }}"
           class="btn-accept"
           style="margin-bottom:10px; display:inline-block;">
            Download Werknemer lijst
        </a>
    @endif


    <br>

    <a href="{{ route('dashboard') }}">⬅ Terug</a>

</x-app-layout>
