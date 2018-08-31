(function () {
    'use strict';

    function Menu() {
        this.world = null;
        this.titleTxt = null;
        this.startTxt = null;
        this.score = 0;
        this.updateUrl = '//' + document.domain + '/UpdateScore';
        this.topListUrl = '//' + document.domain + '/TopList';
    }

    Menu.prototype = {

        create: function () {

            var x = this.game.width * 0.5;
            var y = this.game.height * 0.5;

            this.world.create(0, 0, 'background');

            this.titleTxt = this.add.bitmapText(x, y - 400, 'gamefont', 'FLAPPY BIRD');
            this.titleTxt.scale.setTo(2, 2);
            this.titleTxt.align = 'center';
            this.titleTxt.x = x - this.titleTxt.textWidth;

            this.add.button(x - 125, y + 125, 'start', this.actionOnClick, this);

            var shape = this.add.graphics(x - 200, y - 300);
            shape.lineStyle(5, 0xFFFFFF, 1);
            shape.beginFill(0xddd894, 1);
            shape.drawRect(0, 0, 400, 400);

            this.addScore();
        },

        addScore: function () {
			var score = this.score;
            var topList;
            var topListUrl = this.topListUrl;
			$.ajax({
				'url' : this.updateUrl,
				'type' : 'post',
				'async': false,
				'data': {'data' : encrypt("{\"score\" : " + score + "}")},
				'success' : function(rtn)
				{
                    console.log(rtn);
                    var topListUrlBrocker = topListUrl;
                    var topListBroker;
					$.ajax({
                        'url' : topListUrlBrocker,
                        'type' : 'get',
                        'async': false,
                        'success' : function(rtn)
                        {
                            topListBroker = rtn.data;
                        }
                    });
                    topList = topListBroker;
				}
            });

            var x = this.game.width * 0.5;
            var y = this.game.height * 0.5;

            var text = this.add.bitmapText(x, y - 295, 'gamefont', 'Your Score');
            text.align = 'center';
            text.x = x - text.textWidth * 0.5;

            text = this.add.bitmapText(x, y - 275, 'gamefont', '' + this.score);
            text.align = 'center';
            text.scale.setTo(2, 2);
            text.x = x - text.textWidth;

            text = this.add.bitmapText(x, y - 200, 'gamefont', 'Top3');
            text.align = 'center';
            text.x = x - text.textWidth * 0.5;

			for(var i = 0; i < topList.list.length; ++i)
			{
				if(topList.list[i].score == 0) break;
				if(topList.list[i].userId === topList.currentUser)
				{
					text = this.add.bitmapText(x, y - (150 - 50 * i), 'gamefont', '' + (i + 1) + '  ' + topList.list[i].score + '(YOU!)');
				}
				else
				{
					text = this.add.bitmapText(x, y - (150 - 50 * i), 'gamefont', '' + (i + 1) + '  ' + topList.list[i].score);
				}

				text.align = 'left';
				text.scale.setTo(2, 2);
				text.x = x - 180;
			}
		},

		actionOnClick: function () {
			this.game.state.start('game');
		}
	};

    window['flappybird'] = window['flappybird'] || {};
    window['flappybird'].Menu = Menu;

}());
