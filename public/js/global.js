/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/global.js ***!
  \********************************/
$(document).ready(function () {
  $('.table-25').DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    pageLength: 25
  });
  $('.table-scroll').DataTable({
    scrollY: '85vh',
    scrollX: true,
    scrollCollapse: true,
    paging: false,
    ordering: false
  });
});

var swalAction = function swalAction(url, data) {
  var _paramt$textBtn, _paramt$title;

  var paramt = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  var btnAction = (_paramt$textBtn = paramt.textBtn) !== null && _paramt$textBtn !== void 0 ? _paramt$textBtn : 'Delete ';
  var swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  });
  return swalWithBootstrapButtons.fire({
    title: (_paramt$title = paramt.title) !== null && _paramt$title !== void 0 ? _paramt$title : "Apa anda yakin ?",
    text: "Silahkan Klik Tombol ".concat(btnAction, " Untuk melakukan Aksi"),
    icon: 'info',
    showCancelButton: true,
    confirmButtonText: btnAction,
    cancelButtonText: 'Cancel',
    reverseButtons: true
  }).then(function (result) {
    if (result.value) {
      var _paramt$method;

      $.ajax({
        type: (_paramt$method = paramt.method) !== null && _paramt$method !== void 0 ? _paramt$method : "POST",
        url: url,
        dataType: 'json',
        data: data,
        success: function success(response) {
          if (response.status) {
            Swal.fire({
              icon: 'success',
              title: response.message,
              showConfirmButton: false,
              timer: 2000
            }).then(function (result) {
              window.location.reload();
            });
          } else {
            Swal.fire('Failed', response.message, 'error');
          }
        }
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      swalWithBootstrapButtons.fire('Cancel', "Tidak ada aksi ".concat(btnAction, " data"), 'error');
    }
  });
};
/******/ })()
;