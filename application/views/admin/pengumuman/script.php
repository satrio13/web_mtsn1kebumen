<script>
    $(document).ready(function () {
        handle_datatable();
        handle_confirm_delete();
        handle_validate();  
        handle_summernote();
    });

    function handle_datatable()
    {
        var table;
        table = $("#table-pengumuman").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "backend/get_data_pengumuman",
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

    function handle_summernote()
    {
        $(".textarea").summernote();
    }

    function readURL(input)
    {
        // Mulai membaca inputan gambar
        if (input.files && input.files[0]) {
            var reader = new FileReader(); // Membuat variabel reader untuk API FileReader

            reader.onload = function (e) {
                // Mulai pembacaan file
                $("#preview_gambar") // Tampilkan gambar yang dibaca ke area id #preview_gambar
                    .attr("src", e.target.result);
                //.width(300); // Menentukan lebar gambar preview (dalam pixel)
                //.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function VerifyUploadSizeIsOK()
    {
        var UploadFieldID = "file-upload";
        var MaxSizeInBytes = 1048576;
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
            return false;
        }
        return true;
    } 
</script>