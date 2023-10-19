<script>
    var base_url = '<?= base_url(); ?>';
    var table;
    $(document).ready(function () {
        handle_datatable_isialumni();
        handle_datatable_alumni();
        handle_confirm_delete();
        handle_validate();  
    });

    function handle_datatable_isialumni()
    {
        table = $("#table-isialumni").DataTable({
            processing: true,
            serverSide: true,
            order: [],

            ajax: {
                url: base_url + "backend/get_data_isialumni",
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

    function status(id)
    {
        $('#modal_status').modal('show'); 

        $.ajax({
            url : base_url + "backend/status/"+id,
            type: "GET",
            dataType: "JSON",
            beforeSend: function()
            {
                $("#load_status").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data)
            {
                $("#load_status").html('');
                $('#id').val(data.id);
                $('#status').val(data.status);
            },
            error: function (request)
            {
                alert_gagal('An error occurred during your request: '+  request.status + ' ' + request.statusText + 'Please Try Again!!');
            }
        });
    }

    function save_status()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 

        $.ajax({
            url : base_url + "backend/save-status",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_status').modal('hide');
                alert_sukses('STATUS BERHASIL DIUPDATE');
                reload_table();
                $('#btnSave').html('<i class="fa fa-check"></i> SIMPAN'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },
            error: function (request)
            {
                alert_gagal('An error occurred during your request: '+  request.status + ' ' + request.statusText + 'Please Try Again!!');
                $('#btnSave').html('<i class="fa fa-check"></i> SIMPAN'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }

    function detail(id)
    {
        $('#modal_form').modal('show'); 
        $("#img, #nama, #th_lulus, #sma, #pt, #instansi, #alamatins, #hp, #email, #alamat, #kesan").html('');

        $.ajax({
            url : base_url + "backend/lihat-alumni/"+id,
            type: "GET",
            dataType: "JSON",
            beforeSend: function()
            {
                $("#load").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data)
            {
                var fileUrl = base_url +'assets/img/alumni/'+ data.gambar;
                check_file_exists(fileUrl, function(exists)
                {
                    if(exists)
                    {
                        $("#img").html('<img src="'+ base_url +'assets/img/alumni/'+ data.gambar +'" class="img img-fluid img-thumbnail" width="120px">');
                    }
                });

                $("#load").html('');
                $("#nama").html(': ' + data.nama);
                $("#th_lulus").html(': ' + data.th_lulus);
                $("#sma").html(': ' + data.sma);
                $("#pt").html(': ' + data.pt);
                $("#instansi").html(': ' + data.instansi);
                $("#alamatins").html(': ' + data.alamatins);
                $("#hp").html(': ' + data.hp);
                $("#email").html(': ' + data.email);
                $("#alamat").html(': ' + data.alamat);
                $("#kesan").html(': ' + data.kesan);
            },
            error: function (request)
            {
                alert_gagal('An error occurred during your request: '+  request.status + ' ' + request.statusText + 'Please Try Again!!');
            }
        });
    }

    function handle_datatable_alumni()
    {
        $("#datatable").DataTable();
    }

    function reload_table()
    {
        // Show loading animation
        document.getElementById('loading-animation').style.display = 'block';

        // Reload the table
        table.ajax.reload(function() {
            // This callback function will be executed after the table is reloaded
            // Hide the loading animation
            document.getElementById('loading-animation').style.display = 'none';
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
</script>