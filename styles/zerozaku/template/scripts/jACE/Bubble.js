function Bubble(message) {
	var x = 0, 
		y = 0;
	var height = 24,
		width = nodeCtx.measureText(message).width;
	
	var message = message;
	var life = config.bubbleLife;
	
	return {
		getLife: function() { return life; },
		// Add bubbles to the stack (needs better verbs)
		extend: function(bubble) {
			if(bubble.extension && bubble.extension.extension) {
				bubble.extension.extension = null;
			}
			
			this.extension = bubble;
		},
		update: function(p_x, p_y) {
			x = p_x;
			y = p_y;
			// Decrement the lifespan; nothing lives forever
			life--;
			
			// draw the stacked bubbles
			if (this.extension && this.extension.getLife !== 0) {
				this.extension.update(x, y - 38);
				this.extension.render();
			}
		},
		render: function() {
			nodeCtx.save();
				// Bubble shape
				nodeCtx.fillStyle = color(config.fgColor);
				roundRect(nodeCtx, x - 24, y - height * 2, width + 22, 33, 5, true, true);
	
				// Bubble text
				nodeCtx.fillStyle = color(config.bgColor);
				nodeCtx.font = '11px Tahoma';
				nodeCtx.textAlign = 'left';
				nodeCtx.textBaseline = 'bottom';
				nodeCtx.fillText(message, x - 12, y - height, nodeCanvas.width);
			nodeCtx.restore();
		}
	};
};

Bubble.prototype.extension = null;