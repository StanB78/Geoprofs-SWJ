<x-app-layout>
<h2>Melding Afwijzen</h2>

<p>Weet je zeker dat je deze melding wilt afwijzen?</p>

<ul>
    <li><strong>Gebruiker ID:</strong> {{ $melding->userID }}</li>
    <li><strong>Melding:</strong> {{ $melding->melding }}</li>
    <li><strong>Datum:</strong> {{ $melding->created_at->format('d-m-Y H:i') }}</li>
</ul>

<form action="{{ route('melding.reject', $melding->meldingID) }}" method="GET">
    @csrf
    <a href="{{ route('melding') }}"> Ja, afwijzen</a>
    <a href="{{ route('melding') }}"> Nee, terug</a>
</form>
</x-app-layout>
