<script>
    $(document).ready(function () {
        handle_datatable_isialumni();
        handle_datatable_alumni();
        handle_validate();
    });

    function handle_datatable_isialumni()
    {
        var table;
        table = $("#table-isialumni").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "alumni/get_data_isialumni",
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

    function handle_datatable_alumni()
    {
        $("#datatable").DataTable();
    }

    function handle_validate()
    {
        $("#form").validate();
    }

    function hanyaAngka(evt) 
    {
	    var charCode = evt.which ? evt.which : event.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
	    return true;
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