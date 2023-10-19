<script>
    $(document).ready(function () {
        handle_datatable();
        handle_confirm_delete();
        handle_validate();  
    });

    function handle_datatable()
    {
        var table;
        table = $("#table-download").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "backend/get_data_download",
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
    
    function handle_validate()
    {
        $("#form").validate();
    }
</script>