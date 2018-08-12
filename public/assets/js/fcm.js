
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

	// Retrieve Firebase Messaging object.
	const messaging = firebase.messaging();
	messaging.requestPermission()
	.then(function() {
	  // TODO(developer): Retrieve an Instance ID token for use with FCM.
	  if(isTokenSentToServer()) {
        console.log("hey friends :)");
	  } else {
	  	getRegToken();
	  }

	})
	.catch(function(err) {
	  console.log('Unable to get permission to notify.', err);
	});

	function getRegToken(argument) {
		messaging.getToken()
		  .then(function(currentToken) {
		    if (currentToken) {
		      saveToken(currentToken);
		    } else {
		      console.log('No Instance ID token available. Request permission to generate one.');
		      setTokenSentToServer(false);
		    }
		  })
		  .catch(function(err) {
		    console.log('An error occurred while retrieving token. ', err);
		    setTokenSentToServer(false);
		  });
	}

	function setTokenSentToServer(sent) {
	    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
	}

	function isTokenSentToServer() {
	    return window.localStorage.getItem('sentToServer') == 1;
	}

	function saveToken(currentToken) {
      $.ajax({
      	url: '/send-token/fcm',
        type: 'POST',
        data: {
          token: currentToken
        },
        success: function(){
		  setTokenSentToServer(true);
          console.log('horray');
        }
      });
	}

	messaging.onMessage(function(payload) {
	  document.write("Message received. ", payload);
	  notificationTitle = payload.data.title;
	  notificationOptions = {
	  	body: payload.data.body,
	  	icon: payload.data.icon,
	  	image:  payload.data.image
	  };
	  var notification = new Notification(notificationTitle,notificationOptions);
	});