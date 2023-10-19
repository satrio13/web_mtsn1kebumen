<script>
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
</script>