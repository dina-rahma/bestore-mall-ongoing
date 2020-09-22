<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>

<!-- Sidebar -->
<!-- jQuery Custom Scroller CDN -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
</script>
<!-- Sidebar -->

<!-- Begin:Script Slide -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- End:Script Slide -->
<!-- Initialize Swiper -->
<script type="module">
    import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'

        // Banner
        var swiper = new Swiper('.container-banner-toko', {
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination-banner',
                clickable: true,
            },
        });
        //Slide lainnnya
        var swiper = new Swiper('.container-kategori', {
            slidesPerView: 'auto',
            // centeredSlides: true,
            freeMode: true,
            spaceBetween: 15,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
        //Slide lainnnya
        var swiper = new Swiper('.container-product', {
            slidesPerView: 'auto',
            // centeredSlides: true,
            freeMode: true,
            spaceBetween: 5,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        // Layar Ketika Di Scroll, Untuk Search
        // $(window).on("scroll", function () {
        //         if ($(window).scrollTop() > 30) {
        //             $(".nav-top").addClass("active");
        //         } else {
        //             $(".nav-top").removeClass("active");
        //         }
        // });

        //Untuk Sidebar 
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>

<!-- Untuk Kembali Kehalaman Sebelumnya -->
<script>
    function goBack() {
        window.history.back();
    }
</script>
<!-- Untuk Kembali Kehalaman Sebelumnya -->
<!-- Initialize Swiper -->