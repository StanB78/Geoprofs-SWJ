<h2>Melding accepteren</h2>

<p>Weet je zeker dat je deze melding wilt accepteren?</p>

<ul>
    <li><strong>Gebruiker ID:</strong> {{ $melding->userID }}</li>
    <li><strong>Melding:</strong> {{ $melding->melding }}</li>
    <li><strong>Datum:</strong> {{ $melding->created_at->format('d-m-Y H:i') }}</li>
</ul>

<form action="{{ route('melding.accept', $melding->meldingID) }}" method="POST">
    @csrf
    <button type="submit">Ja, accepteer</button>
    <a href="{{ route('melding.show') }}"> Nee, terug</a>
</form>
