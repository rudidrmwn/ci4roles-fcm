<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Simple CRM</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 	<link rel="stylesheet" href="/css/style.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>	
	<!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
    <script type="text/javascript">
    	var firebaseConfig = {
		    apiKey: "AIzaSyCkmeZiiC2wR7O2K8yl-aYpVdcDX4gSo_s",
		    authDomain: "pushnotif-71c6c.firebaseapp.com",
		    projectId: "pushnotif-71c6c",
		    storageBucket: "pushnotif-71c6c.appspot.com",
		    messagingSenderId: "362481422081",
		    appId: "1:362481422081:web:bdab233a1525e404591500"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);

		var messaging = firebase.messaging();

		navigator.serviceWorker.register('/js/firebase-messaging-sw.js')
		.then(function (registration) {
		    messaging.useServiceWorker(registration);

		    messaging.requestPermission()
		    .then(function () {
		            messaging.getToken()
		            .then(function(token) {
		                console.log(token);
		 				document.cookie = "fcmToken="+token;
		 				
		            })
		            .catch(function(error) {
		                console.log('Error while fetching the token ' + error);
		            });
	        })
	        .catch(function (error) {
	            console.log('Permission denied ' + error);
	        })

		})
		.catch(function () {
		    console.log('Error in registering service worker');
		});


		messaging.onTokenRefresh(function() {
		    messaging.getToken()
		    .then(function(renewedToken) {
		        console.log(renewedToken);
		    })
		    .catch(function(error) {
		        console.log('Error in fetching refreshed token ' + error);
		    });
		});

		messaging.usePublicVapidKey('BIA-dhgSt3VgmmgsECKu8ahFkKUB6EdiQdSwWTDHasqzApy2ks8_w_bLVWyEef8ySLwpP-ocgOwU9X9AphJREDY');

		messaging.onMessage(function(payload) {
		    console.log('onMessage');
			navigator.serviceWorker
		    .register('/assets/js/firebase-messaging-sw.js')
		    .then(function (registration) {
		        console.log("Service Worker Registered");
		        setTimeout(() => {
		            registration.showNotification(payload.notification.title, {
		                body: payload.notification.body
		            });
		            registration.update();
		        }, 100);
		    })
		    .catch(function (err) {
		        console.log("Service Worker Failed to Register", err);
		    })
		});
</script>
    <?= $this->renderSection("body") ?>
</body>
</html>