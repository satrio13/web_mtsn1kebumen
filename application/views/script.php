<script>
    $(document).ready(function () {	
        $(".owl-carousel").owlCarousel({
            loop:true,
            items : 1,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            dots: false,
            nav: true,
            navText: ['<button type"button" class="btn bg-theme text-white" style="border-radius:50%;"><span class="fa fa-chevron-left"></span></button>','<button type"button" class="btn bg-theme text-white" style="border-radius:50%"><span class="fa fa-chevron-right"></span></button>'],
        });
    });
</script>