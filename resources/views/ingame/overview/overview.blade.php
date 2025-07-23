@extends('ingame.layouts.main')

@section('content')
<div class="race-selection-wrapper">
    @if (empty(Auth::user()->race))
        <div id="race-list" class="race-selection-list">
            <h2>Select Your Race</h2>
            <div class="race-options">
                <div class="race-card" onclick="showRaceDetails('human')">
                    <h3>Human</h3>
                    <p>Adaptive and strategic survivors.</p>
                </div>
                <div class="race-card" onclick="showRaceDetails('ai')">
                    <h3>AI-Robot</h3>
                    <p>Machines of precision and logic.</p>
                </div>
                <div class="race-card" onclick="showRaceDetails('cyborg')">
                    <h3>Cyborg</h3>
                    <p>Half-machine, half-organic warriors.</p>
                </div>
            </div>
        </div>

        <div id="race-detail" class="race-detail-box" style="display: none;">
            <h2 id="race-name"></h2>
            <img id="race-image" src="" alt="Race Image" class="race-preview-image">
            <p id="race-description"></p>
            <ul id="race-benefits"></ul>
            <div class="race-detail-buttons">
                <button onclick="goBackToList()">Back</button>
                <button onclick="confirmRace()">Confirm Selection</button>
            </div>
        </div>
    @else
        <div class="race-selected-message">
            <p>You are a <strong>{{ ucfirst(Auth::user()->race) }}</strong>.</p>
        </div>
    @endif
</div>
@endsection

@section('styles')
<style>
.race-card {
    background: #111;
    border: 2px solid #00ff88;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: 0.2s;
}
.race-card:hover {
    background: #00ff88;
    color: #000;
}
.race-preview-image {
    max-width: 100%;
    height: auto;
    margin: 10px 0 20px;
    border: 2px solid silver;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0, 255, 136, 0.3);
}
.race-detail-box {
    background: #111;
    padding: 20px;
    border-radius: 10px;
    color: #b2ffcc;
    border: 2px solid silver;
}
.race-detail-buttons button {
    margin: 10px 5px;
    padding: 10px 20px;
    background: #00ff88;
    border: 1px solid silver;
    border-radius: 6px;
    color: #000;
    cursor: pointer;
}
</style>
@endsection

@section('scripts')
<script>
const raceData = {
    human: {
        name: "Human",
        image: "{{ asset('img/races/human.png') }}",
        description: "Humans have adapted to countless environments through grit, cooperation, and invention.",
        benefits: [
            "+10% resource production",
            "+5% diplomatic influence",
            "Faster exploration"
        ]
    },
    ai: {
        name: "AI-Robot",
        image: "{{ asset('img/races/ai.png') }}",
        description: "Cold, logical, and built for precision and control.",
        benefits: [
            "+15% build speed",
            "Immune to morale",
            "Superior base defense"
        ]
    },
    cyborg: {
        name: "Cyborg",
        image: "{{ asset('img/races/cyborg.png') }}",
        description: "A hybrid of flesh and machine, perfect for hostile worlds.",
        benefits: [
            "+10% combat effectiveness",
            "Health regen over time",
            "Hazard resistance"
        ]
    }
};

let selectedRace = null;

function showRaceDetails(race) {
    selectedRace = race;
    const data = raceData[race];
    document.getElementById('race-name').innerText = data.name;
    document.getElementById('race-description').innerText = data.description;
    document.getElementById('race-image').src = data.image;

    const list = document.getElementById('race-benefits');
    list.innerHTML = '';
    data.benefits.forEach(benefit => {
        const li = document.createElement('li');
        li.textContent = benefit;
        list.appendChild(li);
    });

    document.getElementById('race-list').style.display = 'none';
    document.getElementById('race-detail').style.display = 'block';
}

function goBackToList() {
    selectedRace = null;
    document.getElementById('race-detail').style.display = 'none';
    document.getElementById('race-list').style.display = 'block';
}

function confirmRace() {
    if (!selectedRace) return;

    fetch("{{ route('race.select') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ race: selectedRace })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error("Race selection failed", err));
}
function toggleChat() {
    const shell = document.getElementById('floatingChatShell');
    const header = document.getElementById('chatShellHeader');
    const content = document.getElementById('chatShellContent');

    const panels = content.querySelectorAll('.chat-panel, form');
    const tabs = content.querySelector('.chat-tabs');

    if (shell.classList.contains('collapsed')) {
        // Expand
        header.style.display = 'block';
        panels.forEach(p => p.style.display = 'flex');
        if (tabs) tabs.style.display = 'flex';
        shell.classList.remove('collapsed');
    } else {
        // Collapse
        header.style.display = 'none';
        panels.forEach(p => p.style.display = 'none');
        if (tabs) tabs.style.display = 'flex'; // keep tabs visible
        shell.classList.add('collapsed');
    }
}

</script>
 
@endsection

