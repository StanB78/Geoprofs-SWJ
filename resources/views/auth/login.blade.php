<x-app-layout>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="width: 100%; max-width: 400px; padding: 2rem; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">

            <h1 style="margin-bottom: 1.5rem;">Login</h1>

            @if (session('status'))
                <div style="margin-bottom: 1rem; color: green;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf

                <div style="text-align: left;">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="text-align: left;">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="text-align: left;">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                </div>

                <button type="submit" style="padding: 0.75rem; background: darkorange; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Log in
                </button>

                <div style="margin-top: 1rem;">
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                </div>

                <div>
                    <a href="/register">Register</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
