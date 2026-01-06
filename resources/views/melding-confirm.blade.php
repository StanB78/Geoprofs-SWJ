<x-app-layout>
    <h2>Melding accepteren</h2>

    <p>Weet je zeker dat je deze melding wilt accepteren?</p>

    <form action="{{ route('melding.accept', $melding->meldingID) }}" method="POST">
        @csrf

        <ul>
            <li><strong>Gebruiker ID:</strong> {{ $melding->userID }}</li>
            <li><strong>Melding:</strong> {{ $melding->melding }}</li>
            <li><strong>Datum:</strong> {{ $melding->created_at->format('d-m-Y H:i') }}</li>
            <li>
                <label for="sendmessage">Message</label><br>
                <input
                    id="sendmessage"
                    type="text"
                    name="sendmessage"
                    required
                    style="width: 20%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;"
                >
            </li>
        </ul>

        <button type="submit">Ja, accepteren</button>
        <a href="{{ route('melding') }}">Nee, terug</a>
    </form>
</x-app-layout>
