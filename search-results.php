<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>


<body>
    <section class="body">
        <?php
        include "components/header.php";
        ?>
    </section>

    <section class="body">
        <section class="all-products">
            <div class="header">
                <h1>Searched results</h1>
            </div>
                <div class="slider-container products">
                    <?php
                    include "searched-items.php";
                    ?>
                </div>
        </section>
    </section>
    <?php
    include "components/footer.php";
    ?>
</body>

</html>