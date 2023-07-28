
// ServiceWorker処理：https://developers.google.com/web/fundamentals/primers/service-workers/?hl=ja

// キャッシュ名とキャッシュファイルの指定
var CACHE_NAME = 'pwa-sample-caches-v2';
var urlsToCache = [
	"/",
    "index.php",
	"api/library.php",
	"api/library_data.php",
	"common/session.php",
	"function/repository.php",
	"login_form.php",
	"mail/contact.php",
	"mail/mail.php",
	"profile.php",
	"record.php",
	"register_finish.php",
	"register_form.php",
	"web.php",
	"image/icon-192.png"
];
//document.write("<script type='text/javascript' src='list.js'></script>");

// インストール処理
self.addEventListener('install', function(event) {
	event.waitUntil(
		caches
			.open(CACHE_NAME)
			.then(function(cache) {
				return cache.addAll(urlsToCache);
			})
	);
});

// リソースフェッチ時のキャッシュロード処理
self.addEventListener('fetch', function(event) {
	event.respondWith(
		caches
			.match(event.request)
			.then(function(response) {
				return response ? response : fetch(event.request);
			})
	);
});

