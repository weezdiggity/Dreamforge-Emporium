<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Orbitron', sans-serif;
      background: url('/img/Pink Glow.gif') no-repeat center center fixed;
      background-size: cover;
      color: #00ffe5;
      overflow-x: hidden;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 2rem;
      padding: 3rem 1rem;
    }

    .welcome-box {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 2rem;
      border-radius: 10px;
      border: 2px solid #00ffe5;
      max-width: 600px;
      text-align: center;
      box-shadow: 0 0 20px #00ffe5;
      transition: transform 0.3s;
    }

    .start-button {
      margin-top: 1rem;
      padding: 1rem 2rem;
      font-size: 1.2rem;
      color: #000;
      background: #00ffe5;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .start-button:hover {
      background: #00c7b7;
      transform: scale(1.05);
    }

    .lore-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
      justify-content: center;
    }

    .lore-box {
      width: 300px;
      min-height: 200px;
      background: rgba(0, 0, 0, 0.6);
      border: 2px solid #00ffe5;
      border-radius: 10px;
      padding: 1rem;
      box-shadow: 0 0 12px #00ffe5;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      overflow: hidden;
    }

    .lore-box:hover {
      transform: scale(1.03);
      box-shadow: 0 0 20px #00ffe5;
    }

    .lore-box.open {
      position: fixed;
      top: 5%;
      left: 5%;
      width: 90%;
      height: 90%;
      z-index: 9999;
      overflow-y: auto;
      background: rgba(0, 0, 0, 0.85);
    }

    .lore-box.open .lore-content {
      max-height: 100%;
      overflow-y: auto;
      padding-right: 1rem;
    }

    .close-btn {
      background: #00ffe5;
      border: none;
      color: #000;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      cursor: pointer;
      position: absolute;
      top: 1rem;
      right: 1rem;
      font-size: 1rem;
    }

    .lore-content img {
      max-width: 100%;
      height: auto;
      margin-bottom: 1rem;
      border-radius: 10px;
      border: 1px solid #00ffe5;
    }

    .avatar-slideshow {
      width: 100%;
      max-width: 600px;
      overflow: hidden;
      border: 2px solid #00ffe5;
      border-radius: 10px;
      box-shadow: 0 0 20px #00ffe5;
    }

    .avatar-slideshow img {
      width: 100%;
      height: auto;
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="welcome-box">
      <h1>Welcome to the Galactic Realms of Dreamforge</h1>
      <p>Choose your destiny and embark on a journey across stars, systems, and ancient lore.</p>
      <button class="start-button" onclick="window.location.href='/login'">Start Your Journey</button>
    </div>

    <div class="avatar-slideshow">
      <img id="raceAvatar" src="/img/slideshow/avatar1.jpg" alt="Race Avatar" />
    </div>

    <div class="lore-grid">
      <div class="lore-box" onclick="toggleLore(this)">
        <div class="lore-content">
          <h2>The Void Treaty</h2>
          <img src="/img/lore1.jpg" alt="Lore Image 1">
          <p>For millennia, the empires of Varnak and Xelari battled across the solar belts—until the fateful Void Treaty...</p>
        </div>
        <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
      </div>

      <div class="lore-box" onclick="toggleLore(this)">
        <div class="lore-content">
          <h2>Rise of Mechari</h2>
          <img src="/img/lore2.jpg" alt="Lore Image 2">
          <p>In the wake of organic extinction events, the Mechari emerged from the ruins to govern logic and order...</p>
        </div>
        <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
      </div>

      <div class="lore-box" onclick="toggleLore(this)">
        <div class="lore-content">
          <h2>Ancient Starforge</h2>
          <img src="/img/lore3.jpg" alt="Lore Image 3">
          <p>Discovered buried beneath the Martian Cradle, the Starforge is said to be the birthplace of the ancients...</p>
        </div>
        <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
      </div>

      <div class="lore-box" onclick="toggleLore(this)">
        <div class="lore-content">
          <h2>Whispers of the Rift</h2>
          <img src="/img/lore4.jpg" alt="Lore Image 4">
          <p>Every solstice, a faint signal echoes from the Rift—untranslated, unyielding, unstoppable. What awaits?</p>
        </div>
        <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
      </div>
    </div>
  </div>

  <script>
    function toggleLore(box) {
      document.querySelectorAll('.lore-box').forEach(b => {
        if (b !== box) b.classList.remove('open');
      });
      box.classList.toggle('open');
    }

    function closeLore(button) {
      const box = button.closest('.lore-box');
      box.classList.remove('open');
    }

    // Avatar Slideshow
    const avatars = ['/img/avatar1.png', '/img/avatar2.png', '/img/avatar3.png'];
    let currentAvatar = 0;
    setInterval(() => {
      currentAvatar = (currentAvatar + 1) % avatars.length;
      document.getElementById('raceAvatar').src = avatars[currentAvatar];
    }, 3000);
  </script>
</body>
</html>
