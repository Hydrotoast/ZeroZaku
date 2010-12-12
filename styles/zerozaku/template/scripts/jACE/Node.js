var Node = function() {
	this.id = 0;
	this.name = username;

	this.x = canvas.width / 2;
	this.y = canvas.height / 2;
	this.width = 24;
	this.height = 24;

	this.saying = false;
	this.message = null;
};

Node.prototype.addMessage = function(message) {
	if (this.message !== null) {
		// Stack messages
		var oldBubble = this.message;
		this.message = new Bubble(message);
		this.message.extend(oldBubble);
	} else {
		// Initial message
		this.message = new Bubble(message);
	}
	
	// Start queue processing
	this.saying = true;
};

Node.prototype.say = function() {
	this.message.display(this.x, this.y);
	
	// Kill the queue processing once the last messsage dies
	if (this.message.life === 0) {
		this.saying = false;
	}
};

Node.prototype.display = function() {
	// Set new X coordinates
	if (this.x == mouseX) {
		movingX = false;
	} else {
		this.x += (mouseX > this.x ? dx : -dx);
	}

	// Set new Y coordinates
	if (this.y == mouseY) {
		movingY = false;
	} else {
		this.y += (mouseY > this.y ? dy : -dy);
	}

	// My circle
	ctx.fillStyle = '#212121';
	ctx.beginPath();
	ctx.arc(this.x, this.y, this.width, 0, Math.PI * 2, false);
	ctx.closePath();
	ctx.fill();
	
	// My name
	ctx.font = '11px Tahoma';
	ctx.textAlign = 'left';
	ctx.textBaseline = 'bottom';
	ctx.fillText(this.name, this.x - ctx.measureText(this.name).width/2, this.y + this.height + 13, canvas.width);

	// Queue execution? Needs better abstraction
	if (this.saying) {
		this.say();
	}
};