var Bubble = function(message) {
	var height = 24;
	var width = nodeCtx.measureText(message).width;
	
	var message = message;
	var life = config.bubbleLife;
	
	this.extension = null;
	
	return {
		getLife: function() { return life; },
		// Add bubbles to the stack (needs better verbs)
		extend: function(bubble) {
			if(bubble.extension && bubble.extension.extension) {
				bubble.extension.extension = null;
			}
			
			this.extension = bubble;
		},
		display: function(x, y) {
			// Decrement the lifespan; nothing lives forever
			life--;
			
			// Display the stacked bubbles
			if (this.extension && this.extension.getLife !== 0) {
				this.extension.display(x, y - 38);
			}
			
			// Bubble shape
			nodeCtx.fillStyle = '#FFFFFF';
			roundRect(nodeCtx, x - 24, y - height * 2, width + 22, 33, 5, true, true);

			// Bubble text
			nodeCtx.fillStyle = '#212121';
			nodeCtx.font = '11px Tahoma';
			nodeCtx.textAlign = 'left';
			nodeCtx.textBaseline = 'bottom';
			nodeCtx.fillText(message, x - 12, y - height, nodeCanvas.width);
		}
	};
};