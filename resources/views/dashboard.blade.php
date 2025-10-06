<h1>Ingelogd: {{ Auth::user()?->name ?? 'Niet' }}</h1>

@guest
    <a href="{{ route('login') }}">Log in</a>
@endguest


<a href="{{ route('register') }}">maak nieuw gebruiker</a>
<a href="{{ route('verzuim') }}">verzuim</a>
<a href="{{ route('melding') }}">meldingen</a>

@auth

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log out</button>
    </form>
@endauth
