function Mouse() {
	this.x = nodeCanvas.width * 0.5;
	this.y = nodeCanvas.height * 0.5;
	this.moving = false;
}

Mouse.prototype = {
	move: function() {
		if (this.moving === true) {
			nodes[0].x += nodes[0].velocity * Math.cos(nodes[0].angle);
			nodes[0].y += nodes[0].velocity * Math.sin(nodes[0].angle);
			nodes[0].z -= 0.02;
		}
	}
};

function Keyboard() {
	document.onkeydown = function(evt) {
		switch(evt.which) {
			case 37: // left
				if (message !== document.activeElement) {
					evt.preventDefault();
					nodes[0].turn_left = true;
				}
			break;
			case 38: // up
				if (message !== document.activeElement) {
					evt.preventDefault();
					nodes[0].thrust = true;
				}
			break;
			case 39: // right
				if (message !== document.activeElement) {
					evt.preventDefault();
					nodes[0].turn_right = true;
				}
			break;
			case 40: // down
				if (message !== document.activeElement) {
					evt.preventDefault();
					nodes[0].brake = true;
				}
			break;
			case 32: // space
				if (message !== document.activeElement) {
					evt.preventDefault();
					nodes[0].boost();
				}
			break;
		}
	};
	
	document.onkeyup = function(evt) {
		switch(evt.which) {
			case 37: // left
				nodes[0].turn_left = false;
			break;
			case 38: // up
				nodes[0].thrust = false;
			break;
			case 39: // right
				nodes[0].turn_right = false;
			break;
			case 40: // down
				nodes[0].brake = false;
			break;
		}
	};
}

Keyboard.prototype = {
	move: function() {
		if (nodes[0].turn_left === true) {
			nodes[0].angle -= Math.PI * .02;
			mouse.moving = false;
		}
		
		if (nodes[0].turn_right === true) {
			nodes[0].angle += Math.PI * .02;
			mouse.moving = false;
		}
		
		if (nodes[0].thrust === true) {
			nodes[0].x += nodes[0].velocity * Math.cos(nodes[0].angle);
			nodes[0].y += nodes[0].velocity * Math.sin(nodes[0].angle);
			mouse.moving = false;
		}
		
		if (nodes[0].reverse === true) {
			nodes[0].x -= nodes[0].velocity * 0.4 * Math.cos(nodes[0].angle);
			nodes[0].y -= nodes[0].velocity * 0.4 * Math.sin(nodes[0].angle);
			mouse.moving = false;
		}
	}
};