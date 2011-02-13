var Doodad = {
    clear: function() {
        this.ctx.save();
            this.ctx.translate(this.x, this.y);
            this.ctx.clearRect(0, 0, this.width, this.height);
        this.ctx.restore();
    },
    update: function() {
    },
    render: function() {
        this.ctx.save();
            this.ctx.translate(this.x, this.y);
            this.ctx.drawImage(this.background, 0, 0);
            //this.ctx.fillStyle = $.color('200, 200, 200', 1);
            //this.ctx.fillRect(0, 0, this.width, this.height);
        this.ctx.restore();
    }
};

function SmallRock(p_ctx, p_row, p_column) {
    this.ctx = p_ctx;
    this.x = 380 * p_column;
    this.y = 200 * p_row;

	this.height = 40;
    this.width = 40;

    this.background = new Image();
    this.background.src = './jace/images/doodads/smallrock.png';
};
SmallRock.prototype = Doodad;

function LargeRock(p_ctx, p_row, p_column) {
    this.ctx = p_ctx;
    this.x = 380 * p_column;
    this.y = 200 * p_row;

	this.height = 40;
    this.width = 40;

    this.background = new Image();
    this.background.src = './jace/images/doodads/largerock.png';
};
LargeRock.prototype = Doodad;

function Bush(p_ctx, p_row, p_column) {
    this.ctx = p_ctx;
    this.x = 380 * p_column;
    this.y = 200 * p_row;

	this.height = 40;
    this.width = 40;

    this.background = new Image();
    this.background.src = './jace/images/doodads/bush.png';
};
Bush.prototype = Doodad;

function Fern(p_ctx, p_row, p_column) {
    this.ctx = p_ctx;
    this.x = 380 * p_column;
    this.y = 200 * p_row;

	this.height = 40;
    this.width = 40;

    this.background = new Image();
    this.background.src = './jace/images/doodads/fern.png';
};
Fern.prototype = Doodad;