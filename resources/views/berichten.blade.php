<x-app-layout>
    <h1 class="text-4xl font-black mb-6">Mijn meldingen</h1>

    @if(\App\Http\Middleware\RoleCheck::check(2))
        <div>
            <form method="GET" action="{{ url()->current() }}">
                <select id="user-select" name="selectedUserId">
                    <option value="{{ auth()->id() }}" @if(request('selectedUserId') == auth()->id()) selected @endif>Je zelf</option>
                    <option value="999" @if(request('selectedUserId') == auth()->id()) selected @endif>all</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"@if(request('selectedUserId') == $user->id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">submit</button>
            </form>
        </div>
    @endif


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <h2 class="text-2xl font-black mb-4">Niet behandeld</h2>
            @foreach($meldingen->reverse() as $melding)
                @if( (request('selectedUserId') == 999 || $melding->userID == request('selectedUserId')) && $melding->soort == 2 && $melding->status == null )
                    <div class="bg-gray-300 p-4 rounded mb-4 flex flex-col">
                        <p class="font-bold text-xl">Verlof aanvraag</p>
                        <p><span class="font-semibold">Naam: </span>{{ $users->firstWhere('id', $melding->userID)->name }}</p>
                        <p><span class="font-semibold">User ID:</span> {{ $melding->userID }}</p>
                        <p><span class="font-semibold">Status:</span> In afwachting</p>
                        <p><span class="font-semibold">Melding:</span> {{ $melding->melding }}</p>
                        <p><span class="font-semibold">Startdatum:</span> {{ $melding->startdatum }}</p>
                        <p><span class="font-semibold">Einddatum:</span> {{ $melding->einddatum }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div>
            <h2 class="text-2xl font-black mb-4">Geretourneerd</h2>

            @foreach($meldingen->reverse() as $melding)
                @if( (request('selectedUserId') == 999 || $melding->userID == request('selectedUserId')) && $melding->soort == 2 && $melding->status != null )
                    <div class="{{ $melding->status == 'approved' ? 'bg-green-300' : 'bg-red-300' }} p-4 rounded mb-4 flex flex-col">
                        <p class="font-bold text-xl">Verlof aanvraag</p>
                        <p><span class="font-semibold">Naam: </span>{{ $users->firstWhere('id', $melding->userID)->name }}</p>
                        <p><span class="font-semibold">User ID:</span> {{ $melding->userID }}</p>
                        <p><span class="font-semibold">Status:</span> {{ $melding->status }}</p>
                        <p><span class="font-semibold">Melding:</span> {{ $melding->melding }}</p>
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
                @if( (request('selectedUserId') == 999 || $melding->userID == request('selectedUserId')) && $melding->soort == 1)
                    <div class="bg-gray-300 p-4 rounded mb-4 flex flex-col">
                        <p class="font-bold text-xl">Ziekmelding</p>
                        <p><span class="font-semibold">Naam: </span>{{ $users->firstWhere('id', $melding->userID)->name }}</p>
                        <p><span class="font-semibold">User ID:</span> {{ $melding->userID }}</p>
                        <p><span class="font-semibold">Melding:</span> {{ $melding->melding }}</p>
                        <p><span class="font-semibold">Startdatum:</span> {{ $melding->startdatum }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
