function observerAllCheckIn() {

  var token = document.head.querySelector("meta[name='csrf-token']").content;

  $('.form-check-session').on('change', function(event) {
    var action = $(event.currentTarget).attr('data-action');
    var object = { checkin: event.currentTarget.checked ? 1 : 0 };
    $.ajax({
      url: action,
      data: object,
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token
      }
    })
    .done(function(data) {
      if (data.error) {
        toastr.error(data.message)
      } else {
        toastr.success(data.message)
      }
    });
  });
}


// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
  observerAllCheckIn()
});
