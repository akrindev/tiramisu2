const cacheVersion = 'toram-id-1';

const filesToCache = [
  '/assets/js/jquery.min.js',
  '/assets/js/core.js',
  '/assets/js/vendors/bootstrap.bundle.min.js',
  '/assets/css/dashboard.css',
  '/assets/js/bootstrap-markdown.js',
  '/assets/js/markdown.js',
  '/img/potum.gif',
  '//unpkg.com/sweetalert/dist/sweetalert.min.js'
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheVersion)
      .then(function(cache) {
        return cache.addAll(filesToCache)
      })
  )
});

self.addEventListener('activate',  function(event) {
  event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(res) {
        if (res) return res;

        return fetch(event.request);
      })
  );
});