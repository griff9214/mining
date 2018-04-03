$('form button').click(function (e) {
    console.log(1);
    e.preventDefault();
});
$('div.modal-dialog').onmousedown(function (e) {
    e.preventDefault();
});
// $('form button').click(function (event) {
//     var valid = true;
//
//     if (valid) {
//         formData = $(this).closest('form').serialize();
//         $.ajax({
//             type: 'POST',
//             url: '/mailer.php',
//             context: this,
//             data: formData,
//             beforeSend: function () {
//                 $(this).closest(".modal").modal('hide');
//                 $("#ResultModal").remove();
//             },
//             success: function (data) {
//                 $("body").append(data);
//                 $("#ResultModal").modal();
//             },
//             error: function (xhr, str) {
//                 alert('Ð’Ð¾Ð·Ð½Ð¸ÐºÐ»Ð° Ð¾ÑˆÐ¸Ð±ÐºÐ°: ' + xhr.responseCode);
//             }
//         });
//     }
//
//     event.preventDefault();
// });