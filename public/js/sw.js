var url = '/';
self.addEventListener('push', function(event) {
  if (event.data) {
    var data = event.data.json();
    url = data.id;
    self.registration.showNotification(data.title,{
      body: data.body,
      icon: data.icon,
      tag: 'qureta'
    });
    console.log('This push event has data: ', event.data.text());
  } else {
    console.log('This push event has no data.');
  }
});

self.addEventListener('notificationclick', function(event) {    
    event.notification.close(); // Android needs explicit close.
    event.waitUntil(
        clients.matchAll({type: 'window'}).then( windowClients => {
            // Check if there is already a window/tab open with the target URL
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                // If so, just focus it.
                if (client.url === url && 'focus' in client) {
                    return client.focus();
                }
            }
            // If not, then open the target URL in a new window/tab.
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
});
