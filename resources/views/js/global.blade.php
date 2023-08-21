<script>
    const BASEURL = (pathUrl = '') => {
        return `{{ url('') }}/${pathUrl}`
    };

    $(document).ready(function () {
        $('.table-25').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            pageLength: 25
        });
        $('.table-scroll').DataTable({
            scrollY: '85vh',
            scrollX: false,
            scrollCollapse: true,
            paging: false,
            ordering: false
        });
        $(".dataTables_wrapper").css("width", "100%");
    })

    const swalAction = (url, data, paramt = {}) => {
        const btnAction = paramt.textBtn ?? 'Delete ';
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        return swalWithBootstrapButtons.fire({
            title: paramt.title ?? `Apa anda yakin ?`,
            text: `Silahkan Klik Tombol ${btnAction} Untuk melakukan Aksi`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: btnAction,
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: paramt.method ?? "POST",
                    url: url,
                    dataType: 'json',
                    data: data,
                    success: (response) => {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire('Failed', response.message, 'error')
                        }
                    },
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire('Cancel', `Tidak ada aksi ${btnAction} data`, 'error')
            }
        })
    }

    const numberFormat = (number) => {
        let nf = new Intl.NumberFormat('id-ID');
        return nf.format(number); // "1,234,567,890"
    }


    setTimeout(function () {
        $('#session-notif').fadeOut('slow');
    }, 2500);
</script>
