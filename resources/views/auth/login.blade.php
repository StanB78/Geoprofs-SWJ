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

            </form>

        </div>
    </div>
</x-app-layout>


<script>

    // ========== 1: Check of er al een device uuid bestaat ==========
    if (!localStorage.getItem('device_uuid')) {
        localStorage.setItem('device_uuid', crypto.randomUUID());
    }

    // ========== 2: IP ophalen via backend en opslaan ==========
    // We inject backend IP in JS
    localStorage.setItem('login_ip', "{{ request()->ip() }}");

    // ========== 3: Pogingen opbouwen ==========
    function addAttempt() {
        const current = parseInt(localStorage.getItem('login_attempts')) || 0;
        localStorage.setItem('login_attempts', current + 1);
    }

    function resetAttempts() {
        localStorage.removeItem('login_attempts');
        localStorage.removeItem('login_lock_until');
    }

    // ========== 4: Als je gefaald hebt, teller verhogen ==========
    @if ($errors->any())
    addAttempt();
    @endif

    // ========== 5: Lock instellen ==========
    const maxAttempts = 3;
    const lockTimeMs = 60 * 1000; // 1 minuut

    const attempts = parseInt(localStorage.getItem('login_attempts')) || 0;
    const lockUntil = localStorage.getItem('login_lock_until');
    const now = Date.now();

    if (lockUntil && now < lockUntil) {
        // Nog gelocked
        disableLogin();
    }

    if (attempts >= maxAttempts && !lockUntil) {
        const lockExpires = now + lockTimeMs;
        localStorage.setItem('login_lock_until', lockExpires);
        disableLogin();
    }

    function disableLogin() {
        const button = document.querySelector('button[type="submit"]');
        button.disabled = true;
        button.style.opacity = 0.5;
        button.style.cursor = "not-allowed";

        const msg = document.createElement("div");
        msg.style.color = "red";
        msg.style.marginTop = "10px";

        let lockTime = parseInt(localStorage.getItem('login_lock_until'));

        const interval = setInterval(() => {
            let remaining = Math.max(0, Math.floor((lockTime - Date.now()) / 1000));

            msg.innerText = "Je bent gelocked. Wacht " + remaining + " seconden.";

            if (remaining <= 0) {
                clearInterval(interval);
                resetAttempts();
                location.reload(); // knop wordt weer bruikbaar
            }
        }, 1000);

        document.querySelector('form').appendChild(msg);
    }

</script>

