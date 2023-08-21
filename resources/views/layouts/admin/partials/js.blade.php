<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/config.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@stack('scripts')
@includeIf('js.global')
<script>
    $('.btn-logout').click(function () {
        const urlData = $(this).data('url');
        $.ajax({
            type: "POST",
            url: urlData,
            data: {_token: "{{ csrf_token() }}"},
            dataType: 'json',
            success: function (response) {
                if (response.status === true) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        window.location.reload()
                    })
                } else {
                    Swal.fire('Failed', response.message, 'error')
                }
            }

        });
    })
</script>
