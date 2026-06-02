import './bootstrap';

window.Echo.channel('public-chat')
    .listen('.MessageSent', (e) => {

        console.log('EVENT MASUK:', e);

        const chatBox = document.querySelector('#chat-box');

        if (chatBox) {
            chatBox.innerHTML += `<p>${e.message.message}</p>`;
        }
    });