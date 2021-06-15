require('./bootstrap');
import Echo from 'laravel-echo';

window.clickOnce = true;
window.io = require('socket.io-client');
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ":6001",
});
