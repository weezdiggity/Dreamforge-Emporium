<!DOCTYPE html>
<html>

<head>
    <title>Dreamforge </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="index,follow">
    <meta name="generator" content="GrapesJS Studio">
<style>
  /* Global styles */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #0d0f14;
  color: #e1e5ee;
  margin: 0;
  padding: 0;
}

.game-screen {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100vh;
  padding: 1rem;
}

/* HUD Layouts */
.top-hud, .bottom-hud {
  display: flex;
  justify-content: space-between;
  gap: 1rem;
  padding: 1rem;
  background-color: rgba(22, 26, 34, 0.8);
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

/* Sections */
.academy-section {
  background-color: rgba(32, 36, 48, 0.9);
  padding: 1rem;
  border-radius: 6px;
  flex: 1;
  min-width: 250px;
}

.academy-section h2 {
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
  border-bottom: 1px solid #555;
  padding-bottom: 0.25rem;
  color: #70cfff;
}

.academy-section ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.academy-section ul li {
  margin: 0.25rem 0;
}

/* Loading text */
.loading {
  color: #ffcc00;
  font-weight: bold;
  animation: pulse 1.5s infinite;
}

@keyframes pulse {
  0% { opacity: 0.4; }
  50% { opacity: 1; }
  100% { opacity: 0.4; }
}

/* Rank section */
.rank-info {
  text-align: center;
}

.rank-icon {
  font-size: 2rem;
  margin: 0.5rem 0;
}

/* Comm Feed */
.comm-feed ul.comm-log {
  font-size: 0.9rem;
  color: #ccc;
  line-height: 1.4;
}

.comm-feed ul li {
  padding: 0.25rem 0;
  border-bottom: 1px solid #333;
}
</style>  
</head>


<body id="ieiv" class="gjs-t-body logo">@extends('ingame.layouts.main')

    @section('content')
    <div class="game-screen" id="ijo9l">
        <!-- TOP HUDS -->
        <div class="top-hud academy-hud" id="i8k2g">
            <div class="academy-section status" id="i63qi">
                <h2>Academy Status</h2>
                <ul>
                    <li><strong>Rank:</strong> <span class="loading">Loading...</span></li>
                    <li><strong>Points:</strong> <span class="loading">Loading...</span></li>
                    <li><strong>Current Task:</strong> <span class="loading">Loading...</span></li>
                    <li><strong>Progress:</strong> <span class="loading">Loading...</span></li>
                </ul>
            </div>
            <div class="academy-section">
                <h2>Academy Task List</h2>
                <ul>
                    <li>Tutorial: Move your character</li>
                    <li>Tutorial: Open your inventory</li>
                    <li>Visit the training room</li>
                    <li>Speak to the Commander</li>
                </ul>
            </div>
        </div><!-- BOTTOM HUDS -->
        <div class="bottom-hud academy-hud" id="ib34r">
            <div class="academy-section rank-info" id="iv3nj">
                <h2>Academy Rank</h2>
                <p><strong>Rank:</strong> Cadet</p>
                <div class="rank-icon">🔵</div>
                <p>Your training is progressing well. Keep earning points to reach the next rank!</p>
                <p><strong>Progress:</strong> 430 / 1000 XP</p>
            </div>
            <div class="academy-section actions">
                <h2>Academy Actions</h2><!-- Future interactive elements -->
            </div>
            <div class="academy-section comm-feed">
                <h2>Academy Comm Feed</h2>
                <ul class="comm-log">
                    <li>[LOG 0148-A] — Cadet training simulation #7 has been unlocked.</li>
                    <li>[ADM. RAYNE] — “Courage is not the absence of fear...”</li>
                    <li>[SYSTEM] — The Academy Garden will be offline 22:00–02:00.</li>
                </ul>
            </div>
        </div>
    </div>

    &lt;<div class="relative w-full h-screen overflow-hidden" id="iv9aj">
        <div class="absolute bottom-10 left-0 w-full z-10 flex items-center justify-center">
            <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-lg w-[600px] text-white">
                <h2 class="text-3xl font-bold mb-4">Welcome, {{ $player->get('username') }}</h2>
                <p class="text-sm mb-6">Level {{ $player->level ?? '1' }}</p>
<!--Avatar system
                <h3 class="text-xl font-semibold mb-2">Unlocked Avatars</h3>
                <div class="flex gap-4 justify-center flex-wrap">
                    @foreach($avatars as $avatar)
                    <div><img src="{{ asset($avatar['image']) }}" alt="{{ $avatar['name'] }}" class="avatar-thumb"/>
                        <p class="text-center text-sm mt-1">{{ $avatar['name'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
     
    \\<div id="avatarModal" class="avatar-modal">
        <div class="avatar-modal-content"><span class="avatar-modal-close">×</span><img id="modalAvatarImage" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgc3R5bGU9ImZpbGw6IHJnYmEoMCwwLDAsMC4xNSk7IHRyYW5zZm9ybTogc2NhbGUoMC43NSkiPgogICAgICAgIDxwYXRoIGQ9Ik04LjUgMTMuNWwyLjUgMyAzLjUtNC41IDQuNSA2SDVtMTYgMVY1YTIgMiAwIDAgMC0yLTJINWMtMS4xIDAtMiAuOS0yIDJ2MTRjMCAxLjEuOSAyIDIgMmgxNGMxLjEgMCAyLS45IDItMnoiPjwvcGF0aD4KICAgICAgPC9zdmc+" alt="Avatar"/>
            <p id="modalAvatarName" class="mt-3 font-bold"></p>
            <button type="button" class="avatar-select-btn">Set as Avatar</button>
        </div>
    </div>
    <script>
        let selectedAvatarId = null;

    function openAvatarModal(image, name, id) {
        document.getElementById('modalAvatarImage').src = image;
        document.getElementById('modalAvatarName').innerText = name;
        selectedAvatarId = id;
        document.getElementById('avatarModal').style.display = 'flex';
    }

    function closeAvatarModal() {
        document.getElementById('avatarModal').style.display = 'none';
        selectedAvatarId = null;
    }

    function submitAvatar() {
        fetch("{{ route('profile.avatar') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                avatar: selectedAvatarId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || "Avatar set successfully.");
            closeAvatarModal();
            location.reload();
        })
        .catch(err => {
            console.error(err);
            alert("Something went wrong.");
        });
    }

    </script>
-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    fetch('/academy/status')
        .then(response => response.json())
        .then(data => {
            document.getElementById('academy-rank').textContent = data.rank;
            document.getElementById('academy-points').textContent = data.points;
            document.getElementById('academy-task').textContent = data.task;
            document.getElementById('academy-progress').textContent = data.progress + "%";
        })
        .catch(error => {
            console.error("Error loading academy status:", error);
        });
});
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        fetch("/api/academy/status")
            .then(response => response.json())
            .then(data => {
                document.getElementById("rank").textContent = data.rank;
                document.getElementById("points").textContent = data.points;
                document.getElementById("task").textContent = data.task;
                document.getElementById("progress").textContent = data.progress + "%";
            })
            .catch(error => {
                console.error("Error loading Academy status:", error);
            });
    });
    </script>
    <script>
        function getRank(points) {
    if (points >= 500) return { title: "Cyborg Elite", icon: "🔴" };
    if (points >= 300) return { title: "Sentinel", icon: "🔶" };
    if (points >= 200) return { title: "Specialist", icon: "🟣" };
    if (points >= 100) return { title: "Cadet", icon: "🔵" };
    return { title: "Recruit", icon: "🟢" };
}
function updateRankProgress(currentXP, xpNeeded) {
    const progressPercent = Math.min((currentXP / xpNeeded) * 100, 100);
    document.getElementById('rank-progress-bar').style.width = progressPercent + '%';
    document.getElementById('rank-progress-text').innerText = `Progress: ${currentXP} / ${xpNeeded} XP`;
}

// Example call
updateRankProgress(430, 1000); // Update with real data when available

    document.addEventListener("DOMContentLoaded", function () {
        const tasks = [
            { name: "Tutorial: Move your character", status: "completed" },
            { name: "Tutorial: Open your inventory", status: "active" },
            { name: "Visit the training room", status: "locked" },
            { name: "Speak to the Commander", status: "locked" }
        ];

        const taskList = document.getElementById('academy-tasks');
        taskList.innerHTML = ''; // Clear "Loading..." message

        tasks.forEach(task => {
            const li = document.createElement('li');
            li.textContent = task.name;
            li.classList.add(task.status); // Adds "locked", "active", or "completed"
            taskList.appendChild(li);
        });
    });
    function openRankModal() {
    document.getElementById('rankModal').style.display = 'block';
}

function closeRankModal() {
    document.getElementById('rankModal').style.display = 'none';
}

function showLore(rankKey) {
    const lore = {
        recruit: "The starting point. Recruits are fresh minds entering the Academy, eager to prove their potential.",
        technician: "Tasked with hands-on systems learning and repair, Technicians are critical in early engineering trials.",
        strategist: "Those who’ve passed simulations and tactical assessments now train in field command scenarios.",
        // Add more rank lore as needed
    };
    const box = document.getElementById('loreBox');
    box.innerText = lore[rankKey];
    box.style.display = 'block';
}

function hideLore() {
    document.getElementById('loreBox').style.display = 'none';
}

    </script>
    <script>
        function openMentorModal() {
        document.getElementById("mentorModal").classList.remove("hidden");
    }

    function closeMentorModal() {
        document.getElementById("mentorModal").classList.add("hidden");
    }

    function openExamModal() {
        document.getElementById("examModal").classList.remove("hidden");
    }

    function closeExamModal() {
        document.getElementById("examModal").classList.add("hidden");
    }

    document.getElementById("mentorRequestForm").addEventListener("submit", function(e) {
        e.preventDefault();
        // Optional: send data via fetch/AJAX here
        alert("Mentor request submitted!");
        closeMentorModal();
    });

    document.getElementById("examForm").addEventListener("submit", function(e) {
        e.preventDefault();
        // Optional: send data via fetch/AJAX here
        alert("Promotion exam submitted!");
        closeExamModal();
    });
    </script>

    @endsection
    
</body>


</html>