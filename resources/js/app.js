import './bootstrap';

window.Echo.channel('chat-channel')
    .listen('MessageSent', (e) => {
        alert('Pesan baru: ' + e.message.message);
        location.reload();
    });