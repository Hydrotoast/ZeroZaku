function Doodad(p_ctx, p_type, p_row, p_column, p_xOffset, p_yOffset) {
    var xOffset = (p_xOffset % 380) || 0;
    var yOffset = (p_yOffset % 380) || 0;

    this.ctx = p_ctx;
    this.x = (380 * p_column) + xOffset;
    this.y = (200 * p_row) + yOffset;

    this.background = new Image();
    this.background.src = './jace/images/doodads/' + p_type + '.png';
}

Doodad.prototype = {
    clear: function() {
        this.ctx.save();
            this.ctx.translate(this.x, this.y);
            this.ctx.clearRect(0, 0, this.background.width, this.background.height);
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