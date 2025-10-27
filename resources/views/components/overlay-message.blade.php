@if (session('error'))
    <div id="overlay" class="overlay">
        <div class="message-box">
            {{ session('error') }}
        </div>
    </div>
@endif

@once
    <style>
        .overlay {
            position: fixed;
            background: rgba(0,0,0,0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .message-box {
            background: #fff;
            padding: 20px 30px;
            border: 2px solid red;
            border-radius: 8px;
            font-weight: bold;
            color: #333;
        }
    </style>

@endonce

@once
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('overlay');
            if (!overlay) return;

            overlay.addEventListener('click', () => {
                overlay.style.opacity = '0';
                setTimeout(() => overlay.remove(), 300);
            });
        });
    </script>
@endonce
