<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        @font-face {
            font-family: Inter;
            src: url(fonts/inter/Inter-Regular.ttf);
        }

        .msg-sec {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2%;
        }

        .msg {
            width: 35%;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2%;
            margin-bottom: 80px;
            border: 2px solid #D2D2D2;
            border-radius: 5%;
            gap: 20px;
            font-family: Inter;
            font-size: 1em;
            color: #737373;
        }

        .msg img {
            width: 30%;
        }
    </style>
    <section class="body">
        <?php
        include "components/header.php";
        ?>
        <section class="msg-sec">
            <div class="msg">
                <img src="images/image 9.svg" alt="">
                <p>Thank you for your order! We appreciate your business.<br> You will receive a confirmation email with your order details shortly. You can check your orders directly to <a href="myorders.php">Orders</a>.</p>
            </div>
        </section>
    </section>
    <?php
    include "components/footer.php"
    ?>
</body>

</html>