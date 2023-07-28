$(window).on('load', function () {
    const messaging = firebase.messaging();

    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');

            messaging.getToken({
                vapidKey: "BBNwbVttm3uS3aDaHlJiiRk9jezyxn0YxjVk2P5eVO5VZUPl2MYX8-YqRO-znHtp4o_pYKGZG22-hoEbrIMmdtQ" // public VAPID key
            }).then((currentToken) => {
                if (currentToken) {
                    console.log('Token: ', currentToken);
                    // 確認用にHTMLに表示
                    document.getElementById('token-display').textContent = "Current token: " + currentToken;
                } else {
                    console.log('No Instance ID token available. Request permission to generate one.');
                }
            }).catch((err) => {
                console.log('An error occurred while retrieving token. ', err);
            });
        } else {
            console.log('Unable to get permission to notify.');
        }
    });
});

