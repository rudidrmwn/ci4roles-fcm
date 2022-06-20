importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js");
importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-analytics.js");

var config = {
    apiKey: "AIzaSyCkmeZiiC2wR7O2K8yl-aYpVdcDX4gSo_s",
    authDomain: "pushnotif-71c6c.firebaseapp.com",
    projectId: "pushnotif-71c6c",
    storageBucket: "pushnotif-71c6c.appspot.com",
    messagingSenderId: "362481422081",
    appId: "1:362481422081:web:bdab233a1525e404591500"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const {title, ...options}=JSON.parse(payload.data.notification);
    return self.registration.showNotification(title, options);

});
