/**
 * Maintains location information with respect to the viewport
 * @return
 */
var Node = function() {
	this.id = 0;
	this.name = username;
	this.nodeColor = '#FFFFFF';
	
	this.width = 24;
	this.height = 24;

	this.angle = 1;
	this.x = nodeCanvas.width * 0.5;
	this.y = nodeCanvas.height * 0.5;
	this.z = 1;
	this.turn_left = false;
	this.turn_right = false;
	this.thrust = false;
	this.reverse = false;
	
	this.saying = false;
	this.message = null;

	this.velocity = 2;
	this.acceleration = 1.6;
	this.boostLife = 0;
	this.brakeLife = 0;
};

Node.prototype = {
	_say: function() {
		this.message.update(0, 0);
		this.message.render();
		
		// Kill the queue processing once the last messsage dies
		if (this.message.getLife() === 0) {
			this.saying = false;
		}
	},
	setColor: function(p_nodeColor) {
		// Check for hexadecimal colors
		if(p_nodeColor.match(/#[0-9A-Fa-f]{6}/i))
		{
			this.nodeColor = p_nodeColor;
		}
	},
	addMessage: function(p_message) {
		if (this.message !== null) {
			// Stack messages
			var oldBubble = this.message;
			this.message = new Bubble(p_message);
			this.message.extend(oldBubble);
		} else {
			// Initial message
			this.message = new Bubble(p_message);
		}
		
		// Start queue processing
		this.saying = true;
	},
	boost: function() {
		if (this.boostLife <= 0 && this.velocity == 2) { 
			room.addFx(new Explode(room.getCtx(), room.ox, room.oy, this.width, 5, config.hlColor, 25*6));
			this.boostLife = 15;
		}
	},
	clear: function() {
	},
	update: function() {
		// Set new coordinates
		if (this.x + this.velocity >= mouse.x && this.x - this.velocity <= mouse.x 
				&& this.y + 1 >= mouse.y && this.y - this.velocity <= mouse.y) {
			mouse.moving = false;
			this.z = 1;
			this.boostLife = 0;
		}
		
		if (this.boostLife > 0) {
			if (this.boostLife > 5) {
				this.velocity += this.acceleration;
				this.z -= 0.01;
			} else {
				this.velocity -= this.acceleration * 0.5;
				this.z += 0.01;
			}
			this.boostLife--;
		} else if(this.boostLife === 0) {
			this.velocity = 2;
		}
		
		mouse.move();
		keyboard.move();
		
		if (this.z < 0.75) this.z = 0.75;
		if (this.z > 1) this.z = 1;
	},
	render: function() {
		nodeCtx.save();
			// My circle
			var stroke = this.boostLife <= 0 ? true : false;
			nodeCtx.rotate(this.angle + Math.PI * 0.5, this.angle + Math.PI * 0.5);
			Player(nodeCtx, stroke);
		nodeCtx.restore();
			
		nodeCtx.save();
			// My name
			nodeCtx.fillStyle = color(config.fgColor);
			nodeCtx.font = '11px Tahoma';
			nodeCtx.textAlign = 'left';
			nodeCtx.textBaseline = 'bottom';
			nodeCtx.fillText(this.name, -nodeCtx.measureText(this.name).width/2, this.height + 18, nodeCanvas.width);
			
			// Queue execution? Needs better abstraction
			if (this.saying) {
				this._say();
			}
		nodeCtx.restore();
	}
};