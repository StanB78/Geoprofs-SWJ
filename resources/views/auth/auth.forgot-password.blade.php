<x-app-layout>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="width: 100%; max-width: 400px; padding: 2rem; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">

            <h1 style="margin-bottom: 1.5rem;">Forgot Password</h1>

            @if (session('status'))
                <div style="margin-bottom: 1rem; color: green;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf

                <div style="text-align: left;">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <button type="submit" style="padding: 0.75rem; background: darkorange; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Send Password Reset Link
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
