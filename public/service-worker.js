const cacheName = 'toram-id';

const filesToCache = [
  '/',
  '/assets/css/app.min.css',
  '/assets/js/vendors/bootstrap.bundle.min.js',
  '/assets/js/jquery.min.js',
  '/assets/js/core.js',
  '/assets/css/dashboard.css',
  '/assets/js/bootstrap-markdown.js',
  '/assets/js/markdown.js',
  '/img/logo.png',
  '//unpkg.com/sweetalert/dist/sweetalert.min.js',
  '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
];

self.addEventListener('install', e => {
  e.waitUntil(
    caches.open(cacheName).then(cache => {
      return cache.addAll(filesToCache)
          .then(() => self.skipWaiting());
    })
  );
});

self.addEventListener('activate', event => {
  event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.open(cacheName)
      .then(cache => cache.match(event.request, {ignoreSearch: true}))
      .then(response => {
      return response || fetch(event.request);
    })
  );
});