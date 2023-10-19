<script>
    $(document).ready(function () {
        handle_datatable();
        handle_confirm_delete();
    });
    
    function handle_datatable()
    {
        var table;
        table = $("#table-foto").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "backend/get_data_foto",
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

    function handle_confirm_delete()
    {
        $("#konfirmasi_hapus").on("show.bs.modal", function (e) {
            $(this).find(".btn-ok").attr("href", $(e.relatedTarget).data("href"));
        });
    }

    function VerifyUploadSizeIsOK()
    {
        var UploadFieldID = "file-upload";
        var MaxSizeInBytes = 7340032;
        var fld = document.getElementById(UploadFieldID);
        if(fld.files && fld.files.length == 1 && fld.files[0].size > MaxSizeInBytes)
        {
            setTimeout(function () { 
            swal({
                position: 'top-end',
                icon: 'error',
                title: 'Ukuran gambar/foto terlalu besar!!',
                showConfirmButton: false,
                timer: 5000
            });
            },2000); 
            window.setTimeout(function(){ 
            } ,5000);
            return false;
        }
        return true;
    } 
</script>