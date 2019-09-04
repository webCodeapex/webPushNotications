importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

firebase.initializeApp({
  'messagingSenderId': '<MESSAGE-SENDER-ID>'
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(notification) {
  
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
    body: 'Background Message body.'
    };

    return self.registration.showNotification(notificationTitle,
    notificationOptions);
});