<x-app-layout>
    <h1 class="text-4xl font-black mb-6">Mijn meldingen</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div>
            <h2 class="text-2xl font-black mb-4">Niet behandeld</h2>

            @foreach($meldingen->reverse() as $melding)
                @if($melding->userID == auth()->id() && $melding->soort == 2 && $melding->status == null)
                    <div class="bg-gray-300 p-4 rounded mb-4 flex flex-col">
                        <p class="font-bold text-xl">Verlof aanvraag</p>
                        <p><span class="font-semibold">Melding:</span> {{ $melding->melding }}</p>
                        <p><span class="font-semibold">Status:</span> In afwachting</p>
                        <p><span class="font-semibold">Startdatum:</span> {{ $melding->startdatum }}</p>
                        <p><span class="font-semibold">Einddatum:</span> {{ $melding->einddatum }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div>
            <h2 class="text-2xl font-black mb-4">Geretourneerd</h2>

            @foreach($meldingen->reverse() as $melding)
                @if($melding->userID == auth()->id() && $melding->soort == 2 && $melding->status != null)
                    <div class="bg-gray-300 p-4 rounded mb-4 flex flex-col">
                        <p class="font-bold text-xl">Verlof aanvraag</p>
                        <p><span class="font-semibold">Melding:</span> {{ $melding->melding }}</p>
                        <p><span class="font-semibold">Status:</span> {{ $melding->status }}</p>
                        <p><span class="font-semibold">Startdatum:</span> {{ $melding->startdatum }}</p>
                        <p><span class="font-semibold">Einddatum:</span> {{ $melding->einddatum }}</p>
                        <p><span class="font-semibold">Bericht:</span> {{ $melding->sendmessage }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div>
            <h2 class="text-2xl font-black mb-4">Ziekmeldingen</h2>
            @foreach($meldingen->reverse() as $melding)
                @if($melding->userID == auth()->id() && $melding->soort == 2 &&$melding->status != null)
                    <div class="bg-gray-300 p-4 rounded mb-4 flex flex-col">
                        <p class="font-bold text-xl">Ziekmelding</p>
                        <p><span class="font-semibold">Melding:</span> {{ $melding->melding }}</p>
                        <p><span class="font-semibold">Startdatum:</span> {{ $melding->startdatum }}</p>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</x-app-layout>
