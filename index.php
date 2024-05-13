<?php

$title = "<h1>een <span>titel</span></h1>";
//we requiren de json file. (bekijk hem eens. hij bevat de output van de door vite gegenereerde bestanden)
$manifest = file_get_contents("./dist/manifest.json");
//we lezen hem in als associatieve array
$manifestObject = json_decode($manifest, true);

$continent = "All brutalistic buildings";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monobrut</title>
    <?php
    //hieronder printen we de link-href en de script-src uit. met <?= doe je automatisch een echo.
    ?>
    <link rel="stylesheet" href="./dist/<?= $manifestObject["js/index.js"]["css"][0] ?>">
    <link rel="stylesheet" href="/dist/assets/index.b5c88a40.css">
    <script src="./dist/<?= $manifestObject["js/index.js"]["file"] ?>"></script>
    <script src="./js/utils.js" defer></script>
</head>

<body>
    <header>
        <article class="logo">
            <span class="name">Monobrut<span class="dot">.</span></span>
        </article>
        <nav>
            <a class="links" href="#">Gallery</a>
            <a class="links" href="#">About</a>
            <a class="links" href="#">Contact</a>
        </nav>
    </header>
    <main>
        <article class="hero-content">

            <h1>Concrete monsters<span class="yellow-dot">.</span></h1>
            <h2>Discover buildings, and its brutality founded in the 1950s.</h2>
            <a class="cta-btn" href="#">Discover</a>
        </article>
    </main>
    <article class="gallery">
        <h2>Brutalism in architecture</h2>
        <section>
            <?php

            ?>
            <aside class="_option">
                <p>Filter+</p>
                <button><a href="index.php">All</a></button>
                <button><a href=" index.php?code_cat=1&continent=North America">North America</a></button>
                <button><a href=" index.php?code_cat=2&continent=Latin America">Latin America</a></button>
                <button><a href=" index.php?code_cat=3&continent=Europe">Europe</a></button>
                <button><a href="index.php?code_cat=4&continent=Oceania">Oceania</a></button>
                <button><a href="index.php?code_cat=5&continent=Asia">Asia</a></button>
                <button><a href="index.php?code_cat=6&continent=Africa">Africa</a></button>
            </aside>
        </section>
        <h1 id="continents" class="show_continents"><?php if (isset($_GET['continent'])) {
                                                        echo $_GET['continent'];
                                                    } else {
                                                        echo $continent;
                                                    }
                                                    ?></h1>
        <section class="buildings">
            <!-- <div class="building-card">
                <img src="./uploadFiles/boston-city-hall.jpg" alt="boston city hall">
                <p class="title">hello world title</p>
                <p class="city">hello city</p>
                <a href="#">Information</a>
            </div> -->

            <?php
            //include the DB connection

            if (isset($_GET['code_cat'])) {
                $category = $_GET['code_cat'];
                $continent = $_GET['continent'];
                //echo $code_cat;

                //include the DB connection
                include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/config.php';

                $data = array();
                //SELECT * FROM `buildings` WHERE `idcategories` = 1
                $sql = "SELECT * FROM buildings WHERE idcategories =:category";
                $stmnt = $db_conn->prepare($sql);
                $stmnt->bindParam(":category", $category);
                $stmnt->execute();

                while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                // echo '<pre>';
                // print_r($data);
                // echo '</pre>';
            ?>

                <?php foreach ($data as $index => $building) { ?>

                    <div class="building-card">
                        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/monobrut/uploadFiles/<?= $building['base_img'] ?>">
                        <p class="title"><?= $building['name'] ?></p>
                        <p class="city"><?= $building['city'] ?></p>
                        <a href="buildings/detail.php?id=<?= $building['idbuildings'] ?>">Information</a>
                    </div>
                <?php }

                ?>

            <?php } else {

                include('buildings/showAll.php');
            }
            ?>
        </section>
    </article>
</body>

</html>