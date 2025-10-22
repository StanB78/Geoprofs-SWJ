<x-app-layout>
    <body class="background">
    <div class="auth-header">
        <h1 class="auth-title">
            Logged in as:
            <span class="auth-username">{{ Auth::user()?->name ?? 'Niet' }}</span>
        </h1>

        <div class="auth-actions">
            @guest
                <a href="{{ route('login') }}" class="btn-primary">Log in</a>
            @endguest

                @if(\App\Http\Middleware\RoleCheck::check(3))
                    <a href="{{ route('register') }}" class="btn-secondary">Create new User</a>
                @endif

                <a href="{{ route('verzuim') }}" class="btn-secondary">verzuim</a>
                @if(\App\Http\Middleware\RoleCheck::check(2))
                    <a href="{{ route('melding.show') }}" class="btn-secondary">Melding</a>
                @endif



            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-danger">Log out</button>
                </form>
            @endauth
        </div>
    </div>
    </body>
</x-app-layout>
