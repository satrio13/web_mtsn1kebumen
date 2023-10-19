<script>
    $(document).ready(function () {        
        handle_datatable();
        handle_confirm_delete();
        handle_validate();
        handle_validate_user(); 
    });

    function handle_datatable()
    {
        $("#datatable").DataTable();
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

    function handle_validate_user()
    {
        $('#form-user').validate({
            rules: 
            {
                password2:
                {
                    equalTo: "#password1"
                }
            },
            messages:
            {
                password2:
                {
                    equalTo: "Password tidak sama"
                }
            }
        });
    }
</script>