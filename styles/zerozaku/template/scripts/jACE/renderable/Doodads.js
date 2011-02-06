function Rock(ctx, x, y) {
	var height = 40;
		width = 40;
	
	return {
		clear: function() {
			ctx.save();
				ctx.translate(x, y);
				ctx.clearRect(0, 0, width, height);
			ctx.restore();
		},
		update: function() {
		},
		render: function() {
			ctx.save();
				ctx.translate(x, y);
				ctx.fillStyle = $.color('200, 200, 200', 1);
				ctx.fillRect(0, 0, width, height);
			ctx.restore();
		}
	};
}