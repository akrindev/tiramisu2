const cacheVersion = 'toram-id-2';

const filesToCache = [
  '/assets/js/jquery.min.js',
  '/assets/js/core.js',
  '/assets/js/vendors/bootstrap.bundle.min.js',
  '/assets/css/dashboard.css',
  '/assets/css/app.min.css',
  '/assets/js/bootstrap-markdown.js',
  '/assets/js/markdown.js',
  '/img/potum.png',
  'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
  'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
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
  event.respondWith(caches.match(event.request));
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
    .then(response => {
      if(response) return response;

      return fetch(event.request);
    })
  );
});