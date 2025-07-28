@extends('layouts.guest')

@section('styles')
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: 'Orbitron', sans-serif;
            background: black;
            color: #00f7ff;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: url('/img/warp.gif') center center / cover no-repeat;
            opacity: 0.3;
            z-index: 0;
            animation: zoom 60s infinite linear;
        }

        @keyframes zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.2); }
        }

        .login-box {
            position: relative;
            z-index: 1;
            max-width: 400px;
            margin: 10% auto;
            background: rgba(0, 0, 0, 0.3);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 30px #00f7ff;
            text-align: center;
        }

        .login-box h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .login-box label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.25rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #00b3cc;
        }

        .login-box input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid #00f7ff;
            color: #00f7ff;
            padding: 0.75rem;
            width: 100%;
            border-radius: 5px;
            font-size: 1rem;
        }

        .login-box button {
            background: #00f7ff;
            color: black;
            border: none;
            padding: 1rem;
            font-size: 1rem;
            width: 100%;
            border-radius: 5px;
            margin-top: 1.5rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-box button:hover {
            background: #00b3cc;
        }

        .quote {
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #ccc;
            font-style: italic;
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.1);
            color: #ff8080;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
        }
        .ticker-container {
  position: fixed;
  bottom: 0;
  width: 100%;
  background: rgba(0, 255, 0, 0.1);
  color: #00ff99;
  font-family: 'Courier New', Courier, monospace;
  font-size: 14px;
  overflow: hidden;
  white-space: nowrap;
  border-top: 1px solid #00ffcc;
  box-shadow: 0 -2px 8px rgba(0,255,255,0.3);
  z-index: 1000;
}

.ticker-content {
  display: inline-block;
  padding-left: 100%;
  animation: scrollTicker 40s linear infinite;
}

@keyframes scrollTicker {
  from {
    transform: translateX(0%);
  }
  to {
    transform: translateX(-100%);
  }
}

    </style>
    <div class="ticker-container">
  <div class="ticker-content" id="tickerText">
    ⚔️ Rumor: The Void Marauders once challenged a black hole to a staring contest... and won. |
    📡 Quote: "Unity through entropy." - High Priest of Circuit Faction |
    🚀 Accident: Shuttle #342 mistakenly hyperjumped into a retirement party. No survivors. |
    🛰️ Faction Alert: BioSynth Enclave now accepting volunteers with *at least* two kidneys. |
    🪐 Joke: Why did the asteroid cross the galaxy? To collide with destiny. |
    🔒 Login Tip: Never trust a terminal that compliments your hair.
  </div>
</div>
    @section('scripts')
<script>
    // Background music
    const bgMusic = new Audio('/sounds/Dreamforge.mp3');
    bgMusic.loop = true;
    bgMusic.volume = 0.2;
    document.addEventListener('DOMContentLoaded', () => {
        bgMusic.play().catch(() => {
            // In case autoplay is blocked
            const playOnce = () => {
                bgMusic.play();
                document.removeEventListener('click', playOnce);
            };
            document.addEventListener('click', playOnce);
        });
    });

    // Button click sound
    const clickSound = new Audio('/sounds/login.wav');
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.login-box button');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                clickSound.play();
            });
        });
    });
</script>
@endsection
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
@endsection

@section('content')
    <div class="login-box">
        <h2>Access Dreamforge</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">Identifier Node</label>
                <input id="email" type="email" name="email" required autofocus>
            </div>

            <div>
                <label for="password">Access Phrase</label>
                <input id="password" type="password" name="password" required>
            </div>
<div class="mt-6 flex justify-center">
  <a href="/register" class="text-center px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded-lg shadow-lg transition-all duration-300">
    Create Account
  </a>
</div>
            <button type="submit">Engage Interlink</button>
        </form>

        <div class="quote" id="loginQuote">Initializing Dream Memory...</div>
    </div>
@endsection

@section('scripts')
    <script>
        const quotes = [
            "Echoes converge...",
            "Reality fractures where the Forge pulses strongest.",
            "Accessing Anima Core...",
            "You are not logging in — you are awakening.",
            "Recovered memory fragment detected."
        ];
        document.getElementById('loginQuote').innerText =
            quotes[Math.floor(Math.random() * quotes.length)];
    </script>
    script>
  $(function () {
    $("#registerForm").validationEngine();
  });
</script>
@endsection
