<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>FlappyBird</title>

    <!-- build:css main.min.css -->
    <link rel="stylesheet" href="/FlappyBird/css/main.css">
    <!-- /build -->
</head>

<body>

    <div id="flappybird" class="game"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/phaser/2.2.2/custom/phaser-arcade-physics.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jsencrypt/3.0.0-beta.1/jsencrypt.min.js"></script>

    <!-- build:js main.min.js -->
    <script src="/FlappyBird/js/boot.min.js"></script>
    <script src="/FlappyBird/js/preloader.min.js"></script>
    <script src="/FlappyBird/js/menu.min.js"></script>
    <script src="/FlappyBird/js/game.min.js"></script>
    <script src="/FlappyBird/js/main.min.js"></script>
    <!-- /build -->
    <textarea id="pubkey"hidden>
        <?php echo(file_get_contents(app_path() . '/../key/rsa_1024_pub.pem')); ?>
    </textarea>

</body>

</html>