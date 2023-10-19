<script>
    $(document).ready(function () {    
        handle_image_link();  
    }); 

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