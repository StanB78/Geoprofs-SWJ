<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Register</title>
</head>
<body>
<h1>Register</h1>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <label for="cars">rol:
            <select id="rol" name="rol">

                <option value="1">Werknemer</option>
                <option value="2">Manager/Teamlead</option>
                <option value="3">Administratie/HR</option>
            </select>
        </label>
    </div>
    <div>
        <label for="sector">Sector:</label>
        <select id="sector" name="sector">

            <option value="1">Landmeten Field Teams</option>
            <option value="2">Geo-ICT & Data</option>
            <option value="3">Drone & Imaging</option>
            <option value="4">Bedrijfsvoering</option>
        </select>
    </div>
    <div>
        <button type="submit">Register</button>
    </div>

    <div>
        <a href="{{ route('login') }}">Already registered?</a>
    </div>
</form>
</body>
</html>
