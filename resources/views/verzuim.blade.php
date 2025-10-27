{{--comments--}}
{{--|| date label add so you cant select previous datums --}}
<x-app-layout>
    <form method="POST" action="{{ route('verzuim') }}">
        <h1>verzuim</h1>
        @csrf

        <h2>aantal tokens over: {{ Auth::user()->leaveToken }}</h2>

        <div>
            <label for="melding">Melding</label>
            <input id="melding" type="text" name="melding" value="{{ old('melding') }}" required autofocus>
        </div>

        <div>
            <label for="soort">Soort</label>
            <select id="soort" name="redenverzuim">
                <option value="1">Ziekmelden</option>
                <option value="2">Verlof vragen</option>
            </select>
        </div>

        <div>
            <label for="startdatum">Startdatum</label>
            <input type="date" id="startdatum" name="startdatum">
        </div>

        <div>
            <label for="einddatum">Einddatum</label>
            <input type="date" id="einddatum" name="einddatum">
        </div>

        <div>
            <button type="submit">submit</button>
        </div>
    </form>

    <a href="{{ route('dashboard') }}">terug</a>

    <x-overlay-message />


</x-app-layout>
