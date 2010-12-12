var Bubble = function(message) {
	this.height = 24;
	this.width = ctx.measureText(message).width;
	
	this.message = message;
	this.life = config.bubbleLife;
	this.extension = null;
};

// Add bubbles to the stack (needs better verbs)
Bubble.prototype.extend = function(bubble) {
	if(bubble.extension && bubble.extension.extension) {
		bubble.extension.extension = null;
	}
	
	this.extension = bubble;
};

Bubble.prototype.display = function(x, y) {
	// Decrement the lifespan; nothing lives forever
	this.life--;
	
	// Display the stacked bubbles
	if (this.extension && this.extension.life !== 0) {
		this.extension.display(x, y - 38);
	}
	
	// Bubble shape
	ctx.fillStyle = '#FFFFFF';
	roundRect(ctx, x - 24, y - this.height * 2, this.width + 22, 33, 5, true, true);

	// Bubble text
	ctx.fillStyle = '#212121';
	ctx.font = '11px Tahoma';
	ctx.textAlign = 'left';
	ctx.textBaseline = 'bottom';
	ctx.fillText(this.message, x - 12, y - this.height, canvas.width);
};