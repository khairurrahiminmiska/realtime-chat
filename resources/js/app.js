import './bootstrap';

window.Echo.channel('chat-channel')
    .listen('.MessageSent', (e) => {
        alert('Pesan baru: ' + e.message.message);

        const chatBox = document.querySelector('#chat-box');

        if (chatBox) {
            chatBox.innerHTML += `<p>${e.message.message}</p>`;
        }
    });