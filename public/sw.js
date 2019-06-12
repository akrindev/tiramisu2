const cacheVersion = 'toram-id-1';

const filesToCache = [
  '/assets/js/jquery.min.js',
  '/assets/js/core.js',
  '/assets/js/vendors/bootstrap.bundle.min.js',
  '/assets/css/dashboard.css',
  '/assets/css/app.min.css',
  '/assets/js/bootstrap-markdown.js',
  '/assets/js/markdown.js',
  '/img/potum.png',
  '//unpkg.com/sweetalert/dist/sweetalert.min.js',
  '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheVersion)
      .then(function(cache) {
        return cache.addAll(filesToCache)
      })
  )
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches
            .keys()
            .then((keys) => {
                return Promise.all(
                    keys
                        .filter((key) => {
                            //If your cache name don't start with the current version...
                            return !key.startsWith(cacheVersion);
                        })
                        .map((key) => {
                            //...YOU WILL BE DELETED
                            return caches.delete(key);
                        })
                );
            })
            .then(() => {
                console.log('WORKER:: activation completed. This is not even my final form');
            })
    )
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        // Try the cache
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request);
        }).catch(function(e) {
            //Error stuff
          	console.log(e);
        });
    );
});