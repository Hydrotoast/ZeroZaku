function Explode(ctx, x, y, r, speed, color, duration) {
	var life = 0;
	
	return {
		render: function() {
			ctx.save();
				ctx.translate(x, y);
				ctx.strokeStyle = 'rgba(' + color + ', ' + (1 - life / duration) + ')';
				ctx.lineWidth = 2;
				circle(ctx, r, true);
			ctx.restore();
		},
		update: function() {
			r += speed;
			life += speed;
			if(life > duration) {
				room.removeFx(this);
			}
		},
		clear: function() {
			ctx.save();
				ctx.translate(x, y);
				ctx.clearRect(-r, -r,r * 2, r * 2);
			ctx.restore();
		}
	};
};