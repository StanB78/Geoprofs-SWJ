<!DOCTYPE html>
<html>
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
        <label for="cars">rol:</label>
        <select id="role" name="role">
            <option value="1">Werknemer </option>
            <option value="2">Manager/Teamlead</option>
            <option value="3">Administratie/HR</option>
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
