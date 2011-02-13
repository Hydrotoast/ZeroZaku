function Rock(p_ctx, p_x, p_y) {
    this.ctx = p_ctx;
    this.x = p_x;
    this.y = p_y;

	this.height = 40;
    this.width = 40;
};

Rock.prototype = {
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
            this.ctx.fillStyle = $.color('200, 200, 200', 1);
            this.ctx.fillRect(0, 0, this.width, this.height);
        this.ctx.restore();
    }
};