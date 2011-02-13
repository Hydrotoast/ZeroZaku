function Explode(p_ctx, p_x, p_y, p_r, p_speed, p_color, p_duration) {
    this.ctx = p_ctx;
    this.x = p_x;
    this.y = p_y;
    this.r = p_r;
    this.speed = p_speed;
    this.color = p_color;
    this.duration = p_duration;

	this.life = 0;
}

Explode.prototype = {
    clear: function() {
        this.ctx.save();
            this.ctx.translate(this.x, this.y);
            this.ctx.clearRect(-this.r, -this.r, this.r * 2, this.r * 2);
        this.ctx.restore();
    },
    update: function() {
        this.r += this.speed;
        this.life += this.speed;
        if (this.life >= this.duration) {
            room.removeFx(this);
        }
    },
    render: function() {
        this.ctx.save();
            this.ctx.translate(this.x, this.y);
            this.ctx.strokeStyle = $.color(this.color, (1 - this.life / this.duration));
            this.ctx.lineWidth = 2;
            $.renderCircle(this.ctx, this.r, true);
        this.ctx.restore();
    }
};