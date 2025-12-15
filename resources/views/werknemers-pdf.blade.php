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

<h2>Werknemers Log</h2>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Saldo</th>
        <th>Registratie</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->rol ?? '-' }}</td>
            <td>{{ $user->leaveToken ?? 0 }}</td>
            <td>{{ $user->created_at?->format('d-m-Y H:i') ?? '-' }}</td>

        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
