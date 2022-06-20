# ci4roles-fcm

Send Notification using Codeigniter 4 and Firebase Cloud Messaging (FCM)

### Installing
```
* composer install
* setting configuration hostname, username, password and database in path Config/Database.php or .env files
* setting firebase account on your account
var firebaseConfig = { 
    apiKey: "xxxxxx",
    authDomain: "xxxxx.firebaseapp.com",
    projectId: "xxxxx",
    storageBucket: "xxxxx.appspot.com",
    messagingSenderId: "xxxxx",
    appId: "xxxx"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

var messaging = firebase.messaging();
```
### Executing program
~~~
1. php spark migrate
2. php spark serve
3. http://localhost:8080 or your domain
~~~
### Login User Access Roles
1. Login as Maker

```
email: rudi@mail.com
password: test1234
```
2. Login as Checker
  
```
email: jono@mail.com
password: test1234
```

3. Login as Approval

```
email: firman@mail.com
password: test1234
```

