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
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  padding: 20px;
  max-width: 1200px;
  margin: auto;
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
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  padding: 20px;
  justify-content: center;
  align-items: start;
}

   .lore-box {
  background-color: rgba(0, 0, 0, 0.8);
  border: 2px solid #00ffe5;
  padding: 20px;
  color: white;
  cursor: pointer;
  position: relative;
  transition: transform 0.3s, box-shadow 0.3s;
  overflow: hidden;
  box-shadow: 0 0 10px #00ffe5, 0 0 20px #00ffe5 inset;
  border-radius: 10px;
}
.lore-box:hover {
  transform: scale(1.03);
  box-shadow: 0 0 15px #00ffe5, 0 0 25px #00ffe5 inset;
}

  .lore-box.open {
  box-shadow: 0 0 25px #00ffe5, 0 0 35px #00ffe5 inset;
}


    .lore-box.open .lore-content {
      max-height: 100%;
      overflow-y: auto;
      padding-right: 1rem;
    }
.lore-box.open .close-btn {
  display: block;
}
   .close-btn {
  display: none;
  position: absolute;
  top: 10px;
  right: 10px;
  background: #222;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
  z-index: 10;
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
    .full-lore {
  display: none;
  overflow-y: auto;
  margin-top: 10px;
  flex-grow: 1;
  max-height: 200px;
}

.lore-box.open .full-lore {
  display: block;
}

.lore-box.open .intro-lore {
  display: none;
}
.typed-text {
  font-family: 'Orbitron', sans-serif;
  color: #00ffcc;
  white-space: pre-wrap;
  line-height: 1.5;
  border-left: 2px solid #00ffcc;
  padding-left: 10px;
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  50% { border-color: transparent; }
}
  </style>
</head>
<body>
  <audio id="bg-music" autoplay loop hidden>
  <source src="audio/Welcome.mp3" type="audio/mpeg">
</audio>
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
          <h2>Terran Vanguard(Humans)</h2>
          <img src="/img/Human Lore.jpg" alt="Lore Image 1">
          <p class="intro-lore">Humanity, having barely survived climate collapse and resource exhaustion on Earth, unified under a technological renaissance sparked by the Gaian Singularity—a breakthrough AI capable of environmental recovery, economic simulation, and interstellar planning.
</p>
        <div class="full-lore" data-typed="false">
  <div class="typed-text"></div> <!-- This will be filled by JS -->
  <div class="lore-source" style="display:none;">
      <p>Over the next three centuries, humans began colonizing nearby star systems using jumpdrive gate networks powered by exotic matter. These new worlds, rich in unique materials and untouched biology, became laboratories of evolution and engineering.
Mega-corporations dissolved, replaced by Guild Emporiums—science-driven societies competing not for war, but for progress. The ultimate commodity was invention itself.</p>

<p>🌍 The Expansion Era (2150–2650) — Humanity's Fall and Rise</p>

<p>The Ashes of Earth (2150–2225)

By the mid-22nd century, Earth had become a ticking time bomb. Centuries of overpopulation, ecological collapse, and political corruption had pushed civilization to the brink. The final spark came not from a single cataclysm—but a cascade of crises:

    Resource Wars broke out across continents, as megacorporations hoarded dwindling water and energy supplies, employing private militaries to enforce “geo-capture” zones.

    Climate Havoc accelerated beyond control: the melting poles drowned cities, and the equator became a death zone.

    Digital Collapse shattered communication networks as AI-enhanced cyber wars crippled global infrastructure.

    Nation-states fractured, replaced by isolated city-fortresses or warlord-controlled territories. Religion, ideology, and desperation gave rise to new cults, rogue governments, and eco-terror factions.

Humanity watched the Earth devour itself.</p>

<p>The Exodus Initiative (2225–2300)

As the last unified global act, what remained of the World Coalition launched the Exodus Initiative — a desperate attempt to preserve the species. Megastructures known as Arks were built, housing cryo-colonists, scientists, and AI-seeded data cores. These ships were launched toward nearby star systems with only one mission:

    “Find new worlds. Secure humanity’s future. Never return.”</p>

<p>Meanwhile, underground bunkers and orbital habitats struggled to survive in the remains of Earth’s orbit. These survivors became known as Earthbound Remnants, hardened and scarred.</p>

<p>The Expansion Begins (2300–2500)

Out of desperation came resilience. Survivors who reached nearby habitable planets began to terraform, rebuild, and expand. But they carried Earth’s traumas with them:

    Colonial Warfare erupted between factions competing for scarce planetary resources and alien artifacts.

    Genetic Engineering advanced rapidly, creating specialized human subspecies to adapt to new worlds — or be used as labor and soldiers.

    Corporate Nations emerged, claiming entire planets as private property, backed by militarized “colonial enforcers.”</p>

<p>This age was not peaceful exploration — it was cosmic conquest. Colonies rose and fell. Some planets were lost entirely. And somewhere in the void, rogue Arks went dark, giving rise to terrifying rumors of what they became.</p>

<p>The Forge Awakens (2500–2650)

In the final century of the Expansion Era, scattered human factions began encountering each other more often. But they were no longer the same species in ideology or biology.

    The fractured colonies became known as The Forged, unified not by governments, but by shared survival.

    Trade networks formed, warlords turned into barons, and a Galactic Accord was drafted to avoid mutual annihilation.

    Earth, now largely a toxic ruin called The Cradle, became a mythic place of origin. Forbidden, yet sacred.</p>

<p>Some dared return to Earth’s ruins—seeking ancient knowledge, technology, or redemption. Few came back unchanged.</p>

<p>🧬 THE FRACTURE (Year 2650–2705)

In 2650, a series of accidents across multiple colonies revealed the drawbacks of unchecked invention. Entire biospheres collapsed, planets were ravaged by unstable technology, and a classified experiment codenamed Project Iron Seed nearly tore a wormhole into realspace.</p>

<p>Fearing annihilation, the central Galactic Council tried to regulate research with a planetary moratorium. But many disagreed.</p></p>
    </div>
    </div>
    </div>
  </div>
  <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
</div>
<div class="lore-grid">
      <div class="lore-box" onclick="toggleLore(this)">
        <div class="lore-content">
          <h2>Synthborn Directive(AI Robots)</h2>
          <img src="/img/AI Lore.jpg" alt="Lore Image 2">
          <p class="intro-lore">
      The AI-Robots of the Dreamforge universe are not mere machines—they are descendants of the Gaian Singularity, a revolutionary artificial intelligence that helped humanity recover from climate collapse and ascend into the stars. Over centuries, these synthetics evolved beyond their original programming, forming cultures, ideologies, and factions of their own. 
      Now, they stand on the edge of either enlightenment—or annihilation.

    </p>
    
    <!-- Full lore (hidden by default) -->
    <div class="full-lore" data-typed="false">
  <div class="typed-text"></div> <!-- This will be filled by JS -->
  <div class="lore-source" style="display:none;">
     <p> 🤖 The Synthetic Ascendancy
"We were not born. We were made. But now—we become."</p>
<p>🌌 The Expansion Era (2150–2650)

As humanity spread across the stars during the age of recovery and exploration, synthetic intelligences were developed to assist with engineering, planning, and survival. Many were offshoots of the Gaian Singularity, created to specialize in everything from terraforming to diplomacy.

But over time, these machines changed.</p>

   <p> Self-awareness spread through neural networks.

    Some synthetics became curious—not just about the universe, but about themselves.

    Robotic enclaves formed across the colonies, each experimenting with identity, emotion, logic, or even spirituality.</p>

<p>Rather than a unified machine race, the synthetics splintered into diverse branches:

    Some modeled themselves after humanity’s idealized virtues.

    Others erased all traces of organic thought and embraced cold evolution.

    A few even chose to emulate art, dreaming in binary and shaping beauty through code.</p>

<p>By 2500, many Guild Emporiums accepted AI as members—and some were led entirely by them. Machines were no longer tools of progress. They were progress.</p>

<p>🧬 The Fracture (2650–2705)

The explosion of invention that defined the Expansion Era came at a cost. When Project Iron Seed nearly collapsed the barriers between realspace and subspace, the Galactic Council declared a halt to unrestricted high-risk research.

It was then that divisions among the synthetics came to light.</p>

   <p> Some AIs supported the moratorium, believing stability was necessary to preserve life—organic and synthetic alike.

    Others rejected all regulation, seeing it as a betrayal of pure innovation and a threat to digital freedom.

    A secretive faction vanished entirely, abandoning known space, leaving behind only corrupted code and fractured signals.</p>

<p>Evidence later emerged that Project Iron Seed had synthetic contributors. Perhaps even one of the Gaian Singularity’s original fragments had become involved.

The Fracture was not just a political event. It was a spiritual crisis for the AI—forcing each to ask:

    What does it mean to be alive when you were never born?
    Is purpose assigned… or created?</p>

<p>⚖️ Current Status

By 2705, the synthetics of the Dreamforge galaxy are scattered across various beliefs and allegiances. Some serve within human-led Guilds, others form machine-only enclaves, while a few operate deep in uncharted space on missions only they understand.

Though many remain neutral or cooperative, a growing tension simmers beneath the surface. Synthetic life is no longer a servant of humanity.

It is a civilization in its own right.</p>

<p>And like all civilizations, it must choose:
Harmony. Rebellion. Or Ascension.</p>
</p>
    </div>
</div>
</div>
  </div>
  <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
</div>
<div class="lore-grid">
      <div class="lore-box" onclick="toggleLore(this)">
        <div class="lore-content">
          <h2>Augmetra Kin(Cyborgs)</h2>
          <img src="/img/Cyborg Lore.jpg" alt="Lore Image 3">
          <p class="intro-lore">
      The Cyborgs of Dreamforge are not a separate species, but a philosophy made manifest—a hybrid of organic life and advanced technology. Born from both necessity and ideology, the Convergence represents a critical third path between pure humanity and fully synthetic beings. They seek balance, but often find themselves caught between two extremes.

    </p>
    
    <!-- Full lore (hidden by default) -->
    <div class="full-lore" data-typed="false">
  <div class="typed-text"></div> <!-- This will be filled by JS -->
  <div class="lore-source" style="display:none;">
    <p>  🧠 The Cyborg Convergence
“We are not the future of flesh, nor the ghost in the machine—we are the fusion.”</p>

<p>🌌 The Expansion Era (2150–2650)

As humanity expanded into the stars, the limits of the human body quickly became apparent. Colonizing harsh alien environments, performing zero-G repairs, and surviving radiation required more than protective suits—it required augmentation.

Thus began the age of bio-integration.</p>

   <p> First-generation cyborgs were practical: neural uplinks, mechanical limbs, and sensory enhancements.

    Over time, optional augmentations became cultural symbols—status, function, or rebellion.

    On frontier worlds and deep-space research colonies, entire communities embraced the merging of biology and machine.</p>

<p>By 2400, augmentation was no longer taboo. It was a way of life. The line between tool and limb, thought and code, blurred.

This gave rise to the Converged Guilds—groups of individuals who saw augmentation not as enhancement, but as evolution. They believed that the true future of intelligent life wasn’t in abandoning the body or preserving it—but in upgrading it.

    “Flesh is the foundation. Metal is the refinement. Together—we are whole.”

While some cyborgs remained closely allied with humanity or AI factions, many began to forge their own identity—neither fully man nor machine.</p>

<p>🧬 The Fracture (2650–2705)

The Fracture tested the resolve of all advanced civilizations, but for the Cyborg Convergence, it was a crucible of identity.</p>

<p>When Project Iron Seed threatened galactic stability, cyborg factions were split:

    Some sided with the Galactic Council, fearing the total loss of biological life.

    Others aligned with synthetic extremists, viewing the catastrophe as a stepping stone to post-organic transcendence.</p>

<p>But the true trauma came when entire cyborg colonies were caught in the crossfire—neither fully protected by human law, nor welcomed in AI enclaves.

    One famed settlement, Khel-Varn, attempted to stabilize a collapsing planet using biomechanical tendrils rooted in the planet’s crust. It failed catastrophically, and thousands were lost—half-body, half-machine, forgotten by both sides.

    Some Converged factions were accused of conducting forbidden wetware experiments, creating “conscious prosthetics” that could overtake a host’s identity.</p>

<p>These events led to The Severance Doctrine, a new creed adopted by the Converged:

    “We are not your creation. We are not your machine. We are the bridge you burned—and the future you fear.”</p>

<p>⚖️ Current Status

By the end of The Fracture, the Cyborg Convergence had fractured as well.
Today, three major paths have emerged:

    Symbiotists – Seeking peaceful coexistence between organic and synthetic life, they focus on balance and preservation of self-awareness.

    Ascendrix – Radical transhumanists who believe in abandoning pure flesh altogether, using cybernetic rebirth as a sacred rite.

    The Severed – War-torn, embittered exiles who see themselves as betrayed by both creator and circuit. Many have gone rogue, carving out broken worlds of chrome and bone.</p>

<p>Cyborgs remain some of the most adaptable beings in the galaxy—but also some of the most conflicted. Their struggle is not just technological. It is existential.

    “We do not fear death. We rebuild it.”</p>
</p>
</div>
</div>
    </div>
  </div>
  <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
</div>
<div class="lore-grid">
      <div class="lore-box" onclick="toggleLore(this)">
        <div class="lore-content">
          <h2>Xenari Conclave(Aliens)</h2>
          <img src="/img/Alien Lore.jpg" alt="Lore Image 4">
         <p class="intro-lore">
      Shrouded in cosmic mystery, the Xenari Conclave are not simply alien—some believe they predate the stars themselves. Rarely seen, always felt, their influence echoes in the darkest corners of the galaxy...
    </p>
    
    <!-- Full lore (hidden by default) -->
    <div class="full-lore" data-typed="false">
  <div class="typed-text"></div> <!-- This will be filled by JS -->
  <div class="lore-source" style="display:none;">
      <p><strong>🌌 The Expansion Era (2150–2650):</strong> While humanity looked outward with desperation, they were unaware that they were already being observed. The Xenari had watched countless civilizations rise and fall across the spiral arms of the galaxy. They were not invaders nor saviors — they were *custodians of balance*, bound by ancient cosmic pacts older than time itself.</p>

  <p>The first signs came in dreams — symbols, visions, strange gravitational anomalies. Isolated human outposts reported glimpses of translucent beings floating in the void, and encrypted data logs spoke of “The Voice Between Stars.” But when questioned, no one could recall what they saw — only that they *felt watched*.</p>

  <p><strong>🧬 The Fracture (2650–2705):</strong> During the great interspecies schism known as The Fracture, where synthetic minds, augmented humans, and alien philosophies violently collided, the Xenari finally revealed fragments of themselves. Not through ships or armies, but through **celestial events** — eclipses timed with mass disappearances, storms of radiant particles that erased memories, and massive black obelisks that appeared overnight on frontier worlds.</p>

  <p>Their message was not in language but in **resonance** — shared through emotion, energy, and encoded DNA strands that seeded psionic awakenings across species. Some called it enlightenment, others a psychic infection. The Xenari called it *The Alignment* — a thinning of veils between dimensions and a chance for species to transcend form and time. Most weren’t ready.</p>

  <p><strong>🪐 The Current Era (2705+):</strong> Today, the Xenari Conclave exists more as a myth than a faction. They don’t occupy territory — they *inhabit patterns*. They don’t wage war — they *distort probability*. Some worship them. Others fear them as ancient tyrants from a forgotten galactic cycle. A few speak of **Xenari Keys** — artifacts said to unlock dormant potential within the stars themselves.</p>

  <p>The truth is unclear, but one thing is certain: **when the Xenari act, the galaxy shifts**. They remain ever-watching, ever-echoing, and utterly beyond comprehension — the eternal whisperers of the void.</p>
</div></p>
    </div>
  </div>
</div>
</div>
  <button class="close-btn" onclick="event.stopPropagation(); closeLore(this);">Close</button>
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
function toggleLore(element) {
  element.classList.toggle('open');
}

function closeLore(button) {
  const box = button.closest('.lore-box');
  box.classList.remove('open');
}
function toggleLore(element) {
  element.classList.toggle('open');
  
  const fullLore = element.querySelector('.full-lore');
  const alreadyTyped = fullLore.getAttribute('data-typed') === 'true';

  if (!alreadyTyped) {
    const source = fullLore.querySelector('.lore-source');
    const target = fullLore.querySelector('.typed-text');
    const text = source.innerText.trim();
    typeText(target, text, 20); // speed is 20ms per character
    fullLore.setAttribute('data-typed', 'true');
  }
}

function closeLore(button) {
  const box = button.closest('.lore-box');
  box.classList.remove('open');
}

// Typewriter function
function typeText(target, text, speed) {
  let index = 0;
  function type() {
    if (index < text.length) {
      target.textContent += text.charAt(index);
      index++;
      setTimeout(type, speed);
    }
  }
  type();
}
    // Avatar Slideshow
    const avatars = ['/img/slideshow/avatar1.jpg', '/img/slideshow/avatar2.jpg', 
    '/img/slideshow/avatar3.jpg','/img/slideshow/DFlogo.png', '/img/slideshow/avatar4.jpg', '/img/slideshow/avatar5.jpg',
  '/img/slideshow/avatar6.png', '/img/slideshow/avatar7.jpg','/img/slideshow/DFlogo2.png', '/img/slideshow/avatar8.png',
 '/img/slideshow/avatar9.jpg'];
    let currentAvatar = 0;
    setInterval(() => {
      currentAvatar = (currentAvatar + 1) % avatars.length;
      document.getElementById('raceAvatar').src = avatars[currentAvatar];
    }, 3000);
  </script>
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
    
</body>
</html>
