<button id="chatToggle" class="float-btn float-chat" aria-label="Chat">🤖</button>

<div id="chatPanel" class="chat-panel">
    <div class="hero-gradient" style="padding:14px 18px;font-weight:700;font-size:15px;">{{ __('site.chat.title') }}</div>
    <div class="chat-body" id="chatBody" style="background:#fff;">
        <div class="chat-msg ai">{{ __('site.chat.ai_greeting') }}</div>
    </div>
    <form id="chatForm" style="display:flex;gap:8px;padding:12px;border-top:1px solid var(--line);background:#fff;">
        <input id="chatInput" class="input" autocomplete="off" required>
        <button class="btn btn-gradient btn-sm">➤</button>
    </form>
</div>

<script>
    (function () {
        var toggle = document.getElementById('chatToggle');
        var panel = document.getElementById('chatPanel');
        var form = document.getElementById('chatForm');
        var input = document.getElementById('chatInput');
        var body = document.getElementById('chatBody');
        var conversationId = null;

        toggle.addEventListener('click', function () {
            panel.classList.toggle('open');
            if (panel.classList.contains('open')) input.focus();
        });

        function add(text, who) {
            var div = document.createElement('div');
            div.className = 'chat-msg ' + who;
            div.textContent = text;
            body.appendChild(div);
            body.scrollTop = body.scrollHeight;
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var text = input.value.trim();
            if (!text) return;
            add(text, 'user');
            input.value = '';

            fetch('{{ route('chat.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ message: text, conversation_id: conversationId })
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                conversationId = data.conversation_id;
                add(data.reply, 'ai');
            })
            .catch(function () { add('Error — please try again.', 'ai'); });
        });
    })();
</script>
