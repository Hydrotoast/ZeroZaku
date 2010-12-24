var Node = function() {
	var id = 0;
	var name = username;
	var nodeColor = '#212121';

	var x = nodeCanvas.width / 2;
	var y = nodeCanvas.height / 2;
	var z = 1;
	var width = 24;
	var height = 24;

	var saying = false;
	var message = null;

	var velocity = 2;
	var acceleration = 1.6;
	var boostLife = 0;
	var brakeLife = 0;
	
	var say = function() {
		message.update(x, y);
		message.render();
		
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
		boost: function() {
			if (boostLife <= 0) { 
				room.addFx(new Explode(room.getCtx(), x, y, width, 5, '0, 0, 255', 25*6));
				boostLife = 1;
			}
		},
		update: function() {
			// Set new Y coordinates
			if (x + velocity >= mouseX && x - velocity <= mouseX && y + 1 >= mouseY && y - velocity <= mouseY) {
				moving = false;
				velocity = 2;
				z = 1;
			}
			
			if (boostLife > 0) {
				velocity += acceleration * (-Math.cos(boostLife*Math.PI)/2 + 0.5);
				boostLife = boostLife - 2 / config.FPS;
			}
			
			if (moving === true) {
				x += velocity * Math.cos(angle);
				y += velocity * Math.sin(angle);
				
				z -= 0.01;
				if (z < 0.8) z = 0.8;
				console.log(z);
			}
		},
		render: function() {
			nodeCtx.save();
				nodeCtx.translate(x, y);
				nodeCtx.scale(z, z);
			
				// My circle
				if(boostLife <= 0) {
					nodeCtx.fillStyle = '#0000FF';
					circle(nodeCtx, width + 3, false);
				}
				
				nodeCtx.fillStyle = nodeColor;
				circle(nodeCtx, width, false);
				
				// My name
				nodeCtx.fillStyle = nodeColor;
				nodeCtx.font = '11px Tahoma';
				nodeCtx.textAlign = 'left';
				nodeCtx.textBaseline = 'bottom';
				nodeCtx.fillText(name, -nodeCtx.measureText(name).width/2, height + 18, nodeCanvas.width);
			nodeCtx.restore();
			
			// Queue execution? Needs better abstraction
			if (saying) {
				say();
			}
		}
	};
};