function Bubble(message) {
	this.x = 0,
    this.y = 0;
    this.height = 24,
    this.width = nodeCtx.measureText(message).width;
	
	this.message = message;
	this.life = $.bubbleLife;
};

Bubble.prototype = {
    getLife: function() { return this.life; },
    // Add bubbles to the stack (needs better verbs)
    extend: function(bubble) {
        if(bubble.extension && bubble.extension.extension) {
            bubble.extension.extension = null;
        }

        this.extension = bubble;
    },
    update: function(p_x, p_y) {
        this.x = p_x;
        this.y = p_y;
        // Decrement the lifespan; nothing lives forever
        this.life--;

        // draw the stacked bubbles
        if (this.extension && this.extension.getLife !== 0) {
            this.extension.update(this.x, this.y - 38);
            this.extension.render();
        }
    },
    render: function() {
        nodeCtx.save();
            // Bubble shape
            nodeCtx.fillStyle = $.color($.fgColor);
            $.renderRoundRect(nodeCtx, this.x - 24, this.y - this.height * 2, this.width + 22, 33, 5, true, true);

            // Bubble text
            nodeCtx.fillStyle = $.color($.bgColor);
            nodeCtx.font = '11px Tahoma';
            nodeCtx.textAlign = 'left';
            nodeCtx.textBaseline = 'bottom';
            nodeCtx.fillText(this.message, this.x - 12, this.y - this.height, nodeCanvas.width);
        nodeCtx.restore();
    }
};

Bubble.prototype.extension = null;