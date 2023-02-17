$(function () {
  $(document).on('click', '#send', function () {
    var message = $('#msg').val()
    var get_id = $(this).data('user')
    $.post(
      'http://localhost/xampp/PHP-NEW-PROJECT/Twitter-Clone-App/Assets/core/ajax/messages.php',
      { sendMessage: message, get_id: get_id },
      function (data) {
        getMessages()
        $('#msg').val('')
      },
    )
  })
})
