// キャッシュ名とキャッシュファイルの指定
const CACHE_NAME = 'pwa-sample-caches-v3'; // キャッシュ名を変更して新しいキャッシュを作成
const urlsToCache = [
    "/",
    "index.php",
    "image/icon-192.png"
    // 動的に変わるコンテンツやAPIのレスポンスはキャッシュから除外
];

// インストール処理
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                return cache.addAll(urlsToCache);
            })
    );
    self.skipWaiting(); // 新しいService Workerをすぐにアクティブにする
});

// アクティブ時の古いキャッシュの削除
self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// リソースフェッチ時のキャッシュロード処理（ネットワークに繋がらなければキャッシュを使ってサイトを表示する）
self.addEventListener('fetch', function(event) {//fetch(event.request) でまずネットワークリクエストを試みる
    event.respondWith(//ネットワークリクエストが成功すれば、そのレスポンスが返される
        fetch(event.request).catch(function() {//ネットワークリクエストが失敗すると、.catch 部分が実行される。
            return caches.match(event.request);//.catch 内で caches.match(event.request) が呼び出され、キャッシュ内で該当するリクエストのレスポンスがあればそれが返さる）
        })
    );
});
