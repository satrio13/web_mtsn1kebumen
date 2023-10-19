<script>
    $(document).ready(function () {
        handle_datatable();
        handle_image_link();
    });

    function handle_datatable()
    {
        var table;
        table = $("#table-guru").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "guru/get_data_guru",
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

    function handle_image_link()
    {
        if($(".image-link").length){
            $(".image-link").magnificPopup({
                type: "image",
                gallery: {
                    enabled: true,
                },
            });
        }
    }
</script>