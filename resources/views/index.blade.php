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
    <script src="/FlappyBird/js/encrypt.js"></script>
    <script src="/FlappyBird/js/boot.js"></script>
    <script src="/FlappyBird/js/preloader.js"></script>
    <script src="/FlappyBird/js/menu.js"></script>
    <script src="/FlappyBird/js/game.js"></script>
    <script src="/FlappyBird/js/main.js"></script>
    <!-- /build -->
    <textarea id="pubkey"hidden>
        <!-- paste your public key here -->
        <!--
        -----BEGIN PUBLIC KEY-----
        MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC1cFrIR2Q03PYV+Z3g7GOfexk4
        BwvD20+J90kW3w7VU5o+0X+mugPaw320bGtZy2H09+yQeHAX22GmuKoMd0Eb52qT
        3JBvISILGPTtVRU4jfStlpAc45phX78M8BQkZ6HUEbRjPrUVyfYDqLp09t2lThxR
        +JHKi5qbPoJca4/DJQIDAQAB
        -----END PUBLIC KEY-----
        -->
    </textarea>

</body>

</html>