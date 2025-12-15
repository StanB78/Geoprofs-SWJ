<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Meldingen Log</h2>

<table>
    <thead>
    <tr>
        <th>User ID</th>
        <th>Soort</th>
        <th>Melding</th>
        <th>Status</th>
        <th>Saldo</th>
        <th>Datum</th>
    </tr>
    </thead>
    <tbody>
    @foreach($meldingen as $melding)
        <tr>
            <td>{{ $melding->userID }}</td>
            <td>{{ $melding->soort == 1 ? 'Ziek' : 'Verlof' }}</td>
            <td>{{ $melding->melding }}</td>
            <td>{{ $melding->status ?? 'pending' }}</td>
            <td>{{ $melding->leaveToken }}</td>
            <td>{{ $melding->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
