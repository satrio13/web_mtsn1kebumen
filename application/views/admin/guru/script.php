<script>
    var base_url = '<?= base_url(); ?>';
    $(document).ready(function () {
        handle_datatable();
        handle_confirm_delete();
        handle_validate();  
        handle_summernote();
    });
    
    function handle_datatable()
    {
        var table;
        table = $("#table-guru").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "backend/get_data_guru",
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
        $("#img, #nama, #nip, #duk, #niplama, #nuptk, #nokarpeg, #tmp_lahir, #tgl_lahir, #statuspeg, #golruang, #tmt_cpns, #tmt_pns, #jk,#agama, #alamat, #tingkat_pt, #prodi, #th_lulus, #status, #statusguru, #email").html('');

        $.ajax({
            url : base_url + "backend/lihat-guru/"+id,
            type: "GET",
            dataType: "JSON",
            beforeSend: function()
            {
                $("#load").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data)
            {
                var fileUrl = base_url +'assets/img/guru/'+ data.gambar;
                check_file_exists(fileUrl, function(exists)
                {
                    if(exists)
                    {
                        $("#img").html('<img src="'+ base_url +'assets/img/guru/'+ data.gambar +'" class="img img-fluid img-thumbnail" width="120px">');
                    }
                });

                var tgl_lahir;
                if(data.tgl_lahir != '0000-00-00')
                {
                    tgl_lahir = tgl_indo(data.tgl_lahir);
                }else
                {
                    tgl_lahir = '';
                }

                var tmt_cpns;
                if(data.tmt_cpns != '0000-00-00')
                {
                    tmt_cpns = tgl_indo(data.tmt_cpns);
                }else
                {
                    tmt_cpns = '';
                }

                var tmt_pns;
                if(data.tmt_pns != '0000-00-00')
                {
                    tmt_pns = tgl_indo(data.tmt_pns);
                }else
                {
                    tmt_pns = '';
                }

                var jk;
                if(data.jk == 1)
                {
                    jk = 'Laki-Laki';
                }else if(data.jk == 2)
                {
                    jk= 'Perempuan';
                }else
                {
                    jk = '';
                }

                var agama;
                if(data.agama == '1')
                { 
                    agama = 'Islam'; 
                }else if(data.agama == '2')
                { 
                    agama = 'Kristen Katolik'; 
                }else if(data.agama == '3')
                { 
                    agama = 'Kristen Protestan'; 
                }else if(data.agama == '4')
                { 
                    agama = 'Hindu'; 
                }else if(data.agama == '5')
                { 
                    agama = 'Budha'; 
                }else if(data.agama == '6')
                { 
                    agama = 'Konghuchu'; 
                }else
                {
                    agama = '';
                }

                $("#load").html('');
                $("#nama").html(': ' + data.nama);
                $("#nip").html(': ' + data.nip);
                $("#duk").html(': ' + data.duk);
                $("#niplama").html(': ' + data.niplama);
                $("#nuptk").html(': ' + data.nuptk);
                $("#nokarpeg").html(': ' + data.nokarpeg);
                $("#tmp_lahir").html(': ' + data.tmp_lahir);
                $("#tgl_lahir").html(': ' + tgl_lahir);
                $("#statuspeg").html(': ' + data.statuspeg);
                $("#golruang").html(': ' + data.golruang);
                $("#tmt_cpns").html(': ' + tmt_cpns);
                $("#tmt_pns").html(': ' + tmt_pns);
                $("#jk").html(': ' + jk);
                $("#agama").html(': ' + agama);
                $("#alamat").html(': ' + data.alamat);
                $("#tingkat_pt").html(': ' + data.tingkat_pt);
                $("#prodi").html(': ' + data.prodi);
                $("#th_lulus").html(': ' + data.th_lulus);
                $("#status").html(': ' + data.status);
                $("#statusguru").html(': ' + data.statusguru);
                $("#email").html(': ' + data.email);
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
    
    function handle_validate()
    {
        $("#form").validate();
    }

    function handle_summernote()
    {
        $(".textarea").summernote();
    }

    function tgl_indo(tgl)
    {
        var tanggal = tgl.substr(8,2);
        var bulan = get_bulan(tgl.substr(5,2));
        var tahun = tgl.substr(0,4);
        return tanggal+' '+bulan+' '+tahun;
    }

    function get_bulan(bln)
    {
        var bulan;
        switch(bln)
        {
            case '01':
                bulan = 'Januari';
                break;
            case '02':
                bulan = 'Februari';
                break;
            case '03':
                bulan = 'Maret';
                break;
            case '04':
                bulan = 'April';
                break;
            case '05':
                bulan = 'Mei';
                break;
            case '06':
                bulan = 'Juni';
                break;
            case '07':
                bulan = 'Juli';
                break;
            case '08':
                bulan = 'Agustus';
                break;
            case '09':
                bulan = 'September';
                break;
            case '10':
                bulan = 'Oktober';
                break;
            case '11':
                bulan = 'November';
                break;
            case '12':
                bulan = 'Desember';
                break;
        } 
        return bulan;
    }

    function check_file_exists(url, callback)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', url, true);
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState === 4)
            {
                if(xhr.status === 200)
                {
                    callback(true);
                }else
                {
                    callback(false);
                }
            }
        };
        xhr.send();
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