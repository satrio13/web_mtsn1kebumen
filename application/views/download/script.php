<script>
    $(document).ready(function () {
        handle_datatable();
    });

    function handle_datatable()
    {
        var table;
        table = $("#table-download").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "download/get_data_download",
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
</script>