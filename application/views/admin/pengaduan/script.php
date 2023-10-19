<script>
    $(document).ready(function () {
        handle_datatable();
        handle_confirm_delete();
    });

    function handle_datatable()
    {
        var table;
        table = $("#table-pengaduan").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "backend/get_data_pengaduan",
                type: "POST",
            },

            columnDefs: [
                {
                    targets: [0],
                    orderable: false,
                },
            ],
        });
    }

    function detail(id)
    {
        $('#modal_form').modal('show'); 
        $('#nama, #status, #pengaduan').html('');           

        $.ajax({
            url : base_url + "backend/lihat-pengaduan/"+id,
            type: "GET",
            dataType: "JSON",
            beforeSend: function()
            {
                $("#load").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data)
            {
                var status;
                if(data.status == '1')
                {
                    status = 'Peserta Didik';
                }else if(data.status == '2')
                {
                    status = 'Wali Murid';
                }else if(data.status == '3')
                {
                    status = 'Masyarakat';
                }else
                {
                    status = '';
                }

                $("#load").html('');
                $('#nama').html(': ' + data.nama);               
                $('#status').html(': ' + status);    
                $('#pengaduan').html(': ' + data.isi);    
            },
            error: function (request)
            {
                alert_gagal('An error occurred during your request: '+  request.status + ' ' + request.statusText + 'Please Try Again!!');
            }
        });
    }

    function handle_confirm_delete()
    {
        $("#konfirmasi_hapus").on("show.bs.modal", function (e) {
            $(this).find(".btn-ok").attr("href", $(e.relatedTarget).data("href"));
        });
    }

    function alert_sukses(str)
    {
        setTimeout(function () { 
            swal({
                position: 'top-end',
                icon: 'success',
                title: str,
                timer: 1500
            });
        },2000); 
    }

    function alert_gagal(str)
    {
        setTimeout(function () { 
            swal({
                position: 'top-end',
                icon: 'error',
                title: str,
                timer: 5000
            });
        },2000); 
    }
</script>