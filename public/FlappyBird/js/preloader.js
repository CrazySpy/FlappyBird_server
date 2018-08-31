(function () {
    'use strict';

    function Preloader() {
        this.asset = null;
        this.ready = false;
    }

    Preloader.prototype = {

        preload: function () {
            this.asset = this.add.sprite(this.game.width * 0.5 - 110, this.game.height * 0.5 - 10, 'preloader');

            this.load.onLoadComplete.addOnce(this.onLoadComplete, this);
            this.load.setPreloadSprite(this.asset);

            this.loadResources();
        },

        loadResources: function () {
            this.load.spritesheet('bird', '/FlappyBird/assets/bird.png', 100, 69, 2);

            this.load.image('background', '/FlappyBird/assets/background.png');
            this.load.image('block-top', '/FlappyBird/assets/block-top.png');
            this.load.image('block-bottom', '/FlappyBird/assets/block-bottom.png');
            this.load.image('start', '/FlappyBird/assets/start.png');

            this.load.bitmapFont('gamefont', '/FlappyBird/assets/Arial.png', '/FlappyBird/assets/Arial.xml');
        },

        create: function () {
            this.asset.cropEnabled = false;
        },

        update: function () {
            if (!!this.ready) {
                this.game.state.start('menu');
            }
        },

        onLoadComplete: function () {
            this.ready = true;
        }
    };

    window['flappybird'] = window['flappybird'] || {};
    window['flappybird'].Preloader = Preloader;

}());