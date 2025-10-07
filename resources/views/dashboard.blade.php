<x-app-layout>
    <div class="auth-header">
        <h1 class="auth-title">
            Logged in as:
            <span class="auth-username">{{ Auth::user()?->name ?? 'Niet' }}</span>
        </h1>

        <div class="auth-actions">
            @guest
                <a href="{{ route('login') }}" class="btn-primary">Log in</a>
            @endguest

            <a href="{{ route('register') }}" class="btn-secondary">Create new User</a>

            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-danger">Log out</button>
                </form>
            @endauth
        </div>
    </div>
</x-app-layout>
