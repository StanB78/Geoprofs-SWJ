<x-app-layout>
    <h1 class="text-3xl font-black">Niet behandeld</h1>
    <div class="grid gap-4 ">
        @foreach($meldingen as $melding)
            @if($melding->userID == auth()->id())
                @if($melding->soort == 2)
                    @if($melding->status == null)
                        <div class="bg-gray-300 p-4 rounded w-auto flex flex-col">

                            <p class="font-bold text-2xl"> Verlof aanvraag</p>
                            <p><span>Melding:</span> {{ $melding->melding }}</p>
                            <p><span>uw aanvraag is:</span> In afwachting</p>
                            <p><span>Startdatum:</span> {{ $melding->startdatum }}</p>
                            <p><span>Einddatum:</span> {{ $melding->einddatum }}</p>
                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    </div>


    <h1 class="text-3xl font-black">geretourneerd</h1>
    <div class="grid gap-4 ">
        @foreach($meldingen as $melding)
            @if($melding->userID == auth()->id())
                @if($melding->soort == 2)
                    @if($melding->status != null)
                        <div class="bg-gray-300 p-4 rounded w-auto flex flex-col">

                            <p class="font-bold text-2xl"> Verlof aanvraag</p>
                            <p><span>Melding:</span> {{ $melding->melding }}</p>
                            <p><span>uw aanvraag is:</span> {{ $melding->status }}</p>
                            <p><span>Startdatum:</span> {{ $melding->startdatum }}</p>
                            <p><span>Einddatum:</span> {{ $melding->einddatum }}</p>
                            <p><span>Berciht terug naar u:</span> {{ $melding->sendmessage }}</p>
                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    </div>
</x-app-layout>
