notification = function () {
  $.get(
    'http://localhost/xampp/PHP-NEW-PROJECT/Twitter-Clone-App/Assets/core/ajax/notification.php',
    { showNotification: true },
    function (data) {
      if (data) {
        if (data.notification > 0) {
          $('#notification').addClass('span-i')
          $('#notification').html(data.notification)
        }
        if (data.messages > 0) {
          $('#messages').show()
          $('#messages').addClass('span-i')
          $('#messages').html(data.messages)
        }
      }
    },
    'json',
  )
}

setInterval(notification, 10000)
