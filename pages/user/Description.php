<!DOCTYPE html>
<html lang="en">

<head>
    <<?php 
     include "includes/head.php";
    ?>
</head>

<body>

    <?php 
     include "includes/header.php";
    ?>

    <main class="main">
        <!--==================== Home ====================-->
        <section class="home home__other" id="home">
            <img src="assets/img/home1.jpg" alt="" class="home__img">

            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle"></span>
                    <h1 class="home__data-title">A propos de la filière Miage</h1>
                </div>

            </div>
        </section>

        <!--==================== ABOUT ====================-->
        <section class="about section" id="about">
            <h2 class="section__title">Informations <br> à propos de la filière Miage</h2>
            <div class="about__container container grid">
                
                <div class="about__data">
                    
                    <p class="about__description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, ipsam voluptates ullam facere nemo architecto earum mollitia quaerat sed, nostrum fugit! Nihil voluptates esse quas labore impedit. Ipsam, in cupiditate?
                        Tenetur, eveniet molestiae velit consequuntur expedita illo sapiente esse aut voluptate fugiat minima cum, repudiandae iusto obcaecati, quaerat quia necessitatibus mollitia repellendus accusantium ea amet aspernatur. Vitae sunt adipisci mollitia.
                        Repudiandae aliquid iste ad consectetur ducimus quia laboriosam adipisci. Esse quisquam et illum placeat eum quae cupiditate. Ratione accusamus magnam consequuntur! Ipsam quidem explicabo magnam quibusdam sequi, perspiciatis architecto ex.
                        Itaque eaque dolore perferendis tempora distinctio corporis dicta. Nemo accusamus dolorum laborum nam quae aut, laudantium dolore qui pariatur ratione nisi, id voluptatem modi asperiores repudiandae sapiente dicta porro sit?
                        Commodi quos perferendis magnam ipsum suscipit laudantium eius. Similique maxime aspernatur ullam facilis fugit quod perferendis alias, facere debitis voluptates. Suscipit debitis quisquam fugit cum rerum facilis? Nam, quisquam nesciunt!
                    </p>
                    <!-- <a href="#" class="button">En savoir plus</a> -->
                </div>

                <div class="about__img">
                    <div class="about__img-overlay">
                        <img src="assets/img/about1.jpg" alt="" class="about__img-one">
                    </div>

                    <div class="about__img-overlay">
                        <img src="assets/img/about2.jpg" alt="" class="about__img-two">
                    </div>
                </div>
            </div>
        </section>



        <!--==================== FOOTER ====================-->
        <?php 
            include "includes/footer.php";
        ?>

        <!--========== SCROLL UP ==========-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="mdi mdi-arrow-up scrollup__icon"></i>
        </a>

        <!--=============== SCROLL REVEAL===============-->
        <script src="assets/js/scrollreveal.min.js"></script>

        <!--=============== SWIPER JS ===============-->
        <script src="assets/js/swiper-bundle.min.js"></script>

        <!--=============== MAIN JS ===============-->
        <script src="./assets/js/main.js"></script>
</body>

</html>