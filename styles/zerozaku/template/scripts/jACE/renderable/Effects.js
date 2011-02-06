function Explode(ctx, x, y, r, p_speed, p_color, p_duration) {
	var life = 0;
	
	return {
		clear: function() {
			ctx.save();
				ctx.translate(x, y);
				ctx.clearRect(-r, -r, r * 2, r * 2);
			ctx.restore();
		},
		update: function() {
			r += p_speed;
			life += p_speed;
			if(life >= p_duration) {
				room.removeFx(this);
			}
		},
		render: function() {
			ctx.save();
				ctx.translate(x, y);
				ctx.strokeStyle = $.color(p_color, (1 - life / p_duration));
				ctx.lineWidth = 2;
				$.Circle(ctx, r, true);
			ctx.restore();
		}
	};
}