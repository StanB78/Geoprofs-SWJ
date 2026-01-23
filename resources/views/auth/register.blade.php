<x-app-layout>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="width: 100%; max-width: 400px; padding: 2rem; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">

            <h1 style="margin-bottom: 1.5rem;">Register</h1>

            @if ($errors->any())
                <div style="margin-bottom: 1rem; color: red; text-align: left;">
                    <ul style="padding-left: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}"
                  style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf

                <div style="text-align: left;">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="text-align: left;">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="text-align: left;">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="text-align: left;">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="text-align: left;">
                    <label for="sector">Sector</label>
                    <select id="sector" name="sector"
                            style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;"
                            required>
                        <option value="">-- Select sector --</option>
                        <option value="1">Landmeten Field Teams</option>
                        <option value="2">Geo-ICT & Data</option>
                        <option value="3">Drone & Imaging</option>
                        <option value="4">Bedrijfsvoering</option>
                    </select>
                </div>


                <div style="text-align: left;">
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol"
                            style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="1">Werknemer</option>
                        <option value="2">Manager / Teamlead</option>
                        <option value="3">Administratie / HR</option>
                    </select>
                </div>

                <button type="submit"
                        style="padding: 0.75rem; background: darkorange; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Register
                </button>

                <div style="margin-top: 1rem;">
                    <a href="{{ route('login') }}">Already registered?</a>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
