importScripts('https://www.gstatic.com/firebasejs/5.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/5.2.0/firebase-messaging.js');
/*Update this config*/


  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDt-sH2PdR2HrgJbvaU1iWhgLiToxM4XCc",
    authDomain: "toram-indo.firebaseapp.com",
    databaseURL: "https://toram-indo.firebaseio.com",
    projectId: "toram-indo",
    storageBucket: "toram-indo.appspot.com",
    messagingSenderId: "411334943013"
  }
  firebase.initializeApp(config);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
	icon: payload.data.icon,
	image: payload.data.image
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});