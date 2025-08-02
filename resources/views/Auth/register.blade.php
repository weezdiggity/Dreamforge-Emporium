@extends('layouts.guest')

<!-- Top Left & Below -->
<div class="corner-lore top-left" id="loreLeft"></div>
<div class="corner-lore bottom-left" id="loreLeftBottom"></div>

<!-- Top Right & Below -->
<div class="corner-lore top-right" id="loreRight"></div>
<div class="corner-lore bottom-right" id="loreRightBottom"></div>

@section('content')
<div class="register-page">
  <audio id="bg-music" autoplay loop hidden>
  <source src="audio/Recruit DM.mp3" type="audio/mpeg">
</audio>
<div class="register-container">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="form-title">Register for Dreamforge</h2>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <button type="submit">Create Account</button>
        <div class="console-text">
    <span class="blinking-text">[STATUS: Awaiting Identity Clearance...]</span>
</div>
    </form>
</div>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    const leftTopLore = [
        "📡 Galactic Alert: Wormhole instability near Arcadia Spiral.",
        "🛰️ System Warning: Energy surge detected near dark star cluster.",
        "🤖 AI Forecast: Chance of void storms rising by 37% in southern systems.",
        "🔊 Listening Post #7: 'Unknown transmission intercepted... repeating in loop.'",
    ];

    const leftBottomLore = [
        "⚙️ Faction Call: Tinkerborn recruiting engineers for orbital forge.",
        "📦 Shipment Lost: Supply drop vanished in Nebula C1.",
        "🔮 Oracle Ping: ‘He walks again in the skin of stars.’",
        "🚀 Pilot Log: 'Saw something in the dust. Not debris. Not friendly.'"
    ];

    const rightTopLore = [
        "📺 Channel 9 News: Senate gridlocked over AI border rights.",
        "💼 Syndicate Deal: Major mining rights transferred to Neodyne Corp.",
       "🧬 DNA Spike: Bio-signature match found for lost emperor's bloodline.",
        "🌐 DataNet Leak: \"Exodus-class ship seen warping into forbidden space.\""
    ];

    const rightBottomLore = [
         "🧻 Emergency recall: Planet Z88 outlawed all toilet paper... again.",
    "🌑 Funeral postponed after black hole ate the priest.",
    "🍕 Galactic Pizza Union strike ends in orbital food fight over anchovies.",
    "👽 Alien pranksters disguised moon as giant butt — federation still investigating.",
    "🧠 Mind-swap mishap: Senator and his dog now share voting rights.",
    "💥 Cargo bay 12 exploded after technician microwaved a burrito with the wrapper on.",
    "🐙 Tentacle rights protests escalate — 8 legs, 0 chill.",
    "🚀 Captain vanished mid-warp. Left behind was a sticky note: 'BRB, alternate dimension.'",
    "🦴 Bones discovered on Mars. Turns out: old KFC bucket from 1992 rover picnic.",
    "🌌 Wormhole named 'Karen' demands to speak with the universe's manager.",
    "🎲 Rogue AI now governs everything using D20 dice rolls. Outcome: 'trip over shoelace.'",
    "🎩 Time traveler caught selling NFTs to cavemen. Timeline... unstable.",
    "📉 Star crashed into space bank, economy now 'very stellar but emotionally unstable'.",
    "☕ Galactic coffee ban results in 2.4 million crew members asleep at their posts.",
    "🎧 Intergalactic DJ drops bass so hard, 3 moons vaporized. Worth it.",
    "🛑 Asteroid declared sentient and sues for being called 'space debris'."   
    ];

    let i = 0;

    function updateLore() {
        const update = (id, data) => {
            const el = document.getElementById(id);
            if (el) el.innerHTML = data[i % data.length];
        };

        update('loreLeft',        leftTopLore);
        update('loreLeftBottom',  leftBottomLore);
        update('loreRight',       rightTopLore);
        update('loreRightBottom', rightBottomLore);

        i++;
    }

    updateLore(); // Initial
    setInterval(updateLore, 8000); // Rotate every 8s
});

</script>


<style>
    .lore-screen {
  background: rgba(0, 255, 170, 0.08);
  border: 2px solid rgba(0, 255, 170, 0.4);
  box-shadow: 0 0 12px rgba(0, 255, 170, 0.6), inset 0 0 8px rgba(0, 255, 170, 0.2);
  font-family: 'Share Tech Mono', monospace;
  color: #00ffcc;
  padding: 10px;
  margin: 10px;
  border-radius: 8px;
  backdrop-filter: blur(2px);
  text-shadow: 0 0 2px #00ffcc;
  animation: screenFlicker 3s infinite;
  position: relative;
  overflow: hidden;
}

@keyframes screenFlicker {
  0% { opacity: 1; }
  48% { opacity: 0.97; }
  50% { opacity: 1; }
  52% { opacity: 0.95; }
  100% { opacity: 1; }
}

/* Optional: add scanlines for retro-tech feel */
.lore-screen::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: repeating-linear-gradient(
    to bottom,
    rgba(0, 255, 170, 0.03),
    rgba(0, 255, 170, 0.03) 2px,
    transparent 2px,
    transparent 4px
  );
  pointer-events: none;
  z-index: 1;
}

    .corner-lore {
    position: absolute;
    width: 240px;
    min-height: 80px;
    background: rgba(0, 0, 0, 0.6);
    color: #0ff;
    padding: 12px;
    font-family: 'Courier New', Courier, monospace;
    font-size: 14px;
    line-height: 1.4;
    border-radius: 10px;
    border: 1px solid cyan;
    box-shadow: 0 0 10px cyan;
    z-index: 10;
    animation: fadeIn 0.5s ease-in-out;
}

.top-left    { top: 20px; left: 20px; }
.bottom-left { top: 130px; left: 20px; }

.top-right    { top: 20px; right: 20px; text-align: right; }
.bottom-right { top: 130px; right: 20px; text-align: right; }

@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

    .register-page {
    background: url('/img/Reg.jpg') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.register-container {
    background-color: rgba(0, 0, 0, 0.6);
    padding: 2rem;
    border-radius: 10px;
    max-width: 400px;
    margin: 50px auto;
    box-shadow: 0 0 15px cyan;
    text-align: center;
}

.form-title {
    color: cyan;
    margin-bottom: 20px;
    font-size: 24px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    margin: 10px 0;
    padding: 12px;
    background-color: #111;
    color: cyan;
    border: 1px solid cyan;
    border-radius: 5px;
    font-size: 16px;
}

button {
    margin-top: 15px;
    background-color: cyan;
    color: #000;
    font-weight: bold;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background-color: #00ffff;
}

.error-box {
    color: red;
    margin-bottom: 10px;
    text-align: left;
}
.console-text {
    margin-top: 15px;
    font-family: 'Courier New', Courier, monospace;
    color: #00ffcc;
    background: rgba(0, 0, 0, 0.3);
    padding: 8px;
    border-radius: 6px;
    border: 1px solid cyan;
    box-shadow: 0 0 8px cyan;
    font-size: 14px;
}

.blinking-text {
    animation: blink 1s steps(1, start) infinite;
    display: inline-block;
}

@keyframes blink {
    50% {
        opacity: 0;
    }
}

</style>
<script>
    window.addEventListener('click', () => {
        const audio = document.getElementById('bg-music');
        if (audio && audio.paused) {
            audio.play().catch(e => {
                console.log('Autoplay blocked:', e);
            });
        }
    }, { once: true });
</script>
    