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
        <label for="startdatum"></label>
        <input type="date" id="startdatum" name="startdatum">
    </div>

    <label for="einddatum"></label>
    <input type="date" id="einddatum" name="einddatum">
    <div>
        <button type="submit">submit</button>
    </div>
</form>
<a href="{{ route('dashboard') }}">terug</a>
    </x-app-layout>
