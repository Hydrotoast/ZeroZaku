function Mouse() {
	this.x = nodeCanvas.width * 0.5;
	this.y = nodeCanvas.height * 0.5;
	this.moving = false;
}

Mouse.prototype = {
	move: function() {
		if (this.moving === true) {
			localplayer.x += localplayer.velocity * Math.cos(localplayer.angle);
			localplayer.y += localplayer.velocity * Math.sin(localplayer.angle);
			localplayer.z -= 0.02;
		}
	}
};

function Keyboard() {
    this.moving = true;

	document.onkeydown = function(evt) {
		switch(evt.which) {
			case 37: // left
				if (GUI.message !== document.activeElement) {
					evt.preventDefault();
					localplayer.turn_left = true;
				}
			break;
			case 38: // up
				if (GUI.message !== document.activeElement) {
					evt.preventDefault();
					localplayer.thrust = true;
				}
			break;
			case 39: // right
				if (GUI.message !== document.activeElement) {
					evt.preventDefault();
					localplayer.turn_right = true;
				}
			break;
			case 40: // down
				if (GUI.message !== document.activeElement) {
					evt.preventDefault();
					localplayer.reverse = true;
				}
			break;
			case 32: // space
				if (GUI.message !== document.activeElement) {
					evt.preventDefault();
					localplayer.boost();
				}
			break;
		}
	};
	
	document.onkeyup = function(evt) {
		switch(evt.which) {
			case 37: // left
				localplayer.turn_left = false;
			break;
			case 38: // up
				localplayer.thrust = false;
			break;
			case 39: // right
				localplayer.turn_right = false;
			break;
			case 40: // down
				localplayer.reverse = false;
			break;
		}
	};
}

Keyboard.prototype = {
	move: function() {
		if (localplayer.turn_left === true) {
			localplayer.angle -= Math.PI * .02;
			mouse.moving = false;
		}
		
		if (localplayer.turn_right === true) {
			localplayer.angle += Math.PI * .02;
			mouse.moving = false;
		}
		
		if (localplayer.thrust === true) {
            localplayer.reverse = false;
			localplayer.x += localplayer.velocity * Math.cos(localplayer.angle);
			localplayer.y += localplayer.velocity * Math.sin(localplayer.angle);
			localplayer.z -= 0.02;
			mouse.moving = false;
		} else {
			localplayer.z += 0.02
		}
		
		if (localplayer.reverse === true) {
            localplayer.thrust = false;
			localplayer.x -= localplayer.velocity * 0.4 * Math.cos(localplayer.angle);
			localplayer.y -= localplayer.velocity * 0.4 * Math.sin(localplayer.angle);
			mouse.moving = false;
		}
	}
};