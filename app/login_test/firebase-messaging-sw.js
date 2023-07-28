importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');


firebase.initializeApp({
    apiKey: "AIzaSyAtgi3Zgm3hI3LLK1i7HwQZijgUdFxui1A",
    authDomain: "source-pack.firebaseapp.com",
    projectId: "source-pack",
    storageBucket: "source-pack.appspot.com",
    messagingSenderId: "610617270696",
    appId: "1:610617270696:web:830036e658b04f5c5b7d9d"
});

const messaging = firebase.messaging();//Firebase Cloud Messagingの機能を利用するためのメソッド

messaging.onBackgroundMessage((payload) => {//この関数はFirebaseが提供しているAPIで、バックグラウンドで受信したメッセージ（プッシュ通知）に対する処理を定義
    //この関数は引数としてコールバック関数を受け取り、そのコールバック関数は受信したメッセージ（payload）を引数として実行する
    //payloadはFirebaseから送られてくるメッセージの内容が格納されているので変更は不可
    console.log('[firebase-messaging-sw.js] Received background message ', payload);//プッシュ通知の内容はコンソールロゴにも表示される
    // 通知のカスタマイズ
    const notificationTitle = payload.notification.title;//payload.notification.titleというプロパティはFirebaseが送信したメッセージ内の構造を表していて、これ自体を変更することはできない
    const notificationOptions = {
        body: payload.notification.body,
    };

    return self.registration.showNotification(//この部分はService Workerが提供するAPIで、ブラウザの通知を表示するためのもの。この関数に通知のタイトルとオプション（通知の本文など）を渡すことで、通知を表示
        //self.registrationプロパティ＝現在のService Workerの登録(Registration)を参照
        //showNotification巻数＝Notification APIのメソッドで、デスクトップ通知を表示
        notificationTitle,
        notificationOptions
    );
});