var Node = function() {
	var id = 0;
	var name = username;
	var nodeColor = '#212121';

	var x = nodeCanvas.width / 2;
	var y = nodeCanvas.height / 2;
	var width = 24;
	var height = 24;

	var saying = false;
	var message = null;

	var say = function() {
		message.display(x, y);
		
		// Kill the queue processing once the last messsage dies
		if (message.getLife() === 0) {
			saying = false;
		}
	};
	
	return {
		getX: function() { return x; },
		getY: function() { return y; },
		setColor: function(p_nodeColor) {
			// Check for hexadecimal colors
			if(p_nodeColor.match(/#[0-9A-Fa-f]{6}/i))
			{
				nodeColor = p_nodeColor;
			}
		},
		addMessage: function(p_message) {
			if (message !== null) {
				// Stack messages
				var oldBubble = message;
				message = new Bubble(p_message);
				message.extend(oldBubble);
			} else {
				// Initial message
				message = new Bubble(p_message);
			}
			
			// Start queue processing
			saying = true;
		},
		display: function() {
			// Set new X coordinates
			if (x + 1 >= mouseX && x - 1 <= mouseX) {
				movingX = false;
			} else {
				x += (mouseX > x ? dx : -dx);
			}
	
			// Set new Y coordinates
			if (y + 1 >= mouseY && y - 1 <= mouseY) {
				movingY = false;
			} else {
				y += (mouseY > y ? dy : -dy);
			}
	
			// My circle
			nodeCtx.fillStyle = nodeColor;
			nodeCtx.beginPath();
			nodeCtx.arc(x, y, width, 0, Math.PI * 2, false);
			nodeCtx.closePath();
			nodeCtx.fill();
			
			// My name
			nodeCtx.font = '11px Tahoma';
			nodeCtx.textAlign = 'left';
			nodeCtx.textBaseline = 'bottom';
			nodeCtx.fillText(name, x - nodeCtx.measureText(name).width/2, y + height + 13, nodeCanvas.width);
			
			// Queue execution? Needs better abstraction
			if (saying) {
				say();
			}
		}
	};
};