<div class="faction-join-container" style="text-align: center; padding: 30px;">
    <h2 style="font-size: 24px; color: #00FFAA;">Join The Voidborn</h2>
    <p style="color: #ccc; margin-bottom: 20px;">A faction of silent watchers from the depths of space. Join us, and reshape destiny.</p>

    <form method="POST" action="{{ route('alliance.join') }}">
        @csrf
        <input type="hidden" name="alliance_id" value="1">
        <button type="submit" class="btn" style="background-color: #00FFAA; color: #000; padding: 10px 20px; border-radius: 5px;">
            Enlist in The Voidborn
        </button>
    </form>
</div>