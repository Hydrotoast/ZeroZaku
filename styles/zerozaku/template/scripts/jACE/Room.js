/**
 * Defines the set of boundaries of the movable region
 * @param canvasId
 * @return
 */
var Room = function(canvasId) {
	var canvas = document.getElementById(canvasId);
	var ctx = canvas.getContext('2d');
    
	var fx = [];
	var doodads = [];

    //var background = $.color($.bgColor);
	var background = new Image();
    background.src = $.bgImg;
            
	var	dx = 0,
		dy = 0;

	return {
		ox: 0,
		oy: 0,
		height: canvas.height * 2,
		width: canvas.width * 2,
		getCtx: function() { return ctx; },
		// Add effects to the room
		addFx: function(p_fx) {
			fx.push(p_fx);
		},
		// Remove effects from the room
		removeFx: function(p_fx) {
			fx.splice(fx.indexOf(p_fx), 1);
		},
		addDoodad: function(p_doodad) {
			doodads.push(p_doodad);
		},
		removeDoodad: function(p_doodad) {
			doodads.splice(doodads.indexOf(p_doodad), 1);
		},
		update: function(p_x, p_y){
			if (mouse.moving === true) {
				dx = p_x;
				dy = p_y;
				theta = Math.atan2(dx, dy);
			}
			
			// Update effects
			var i = fx.length;
			while(i--) {
				fx[i].update();
			}
		},
		render: function() {
			//ctx.fillStyle = background;
			// The set of all movable points 2x the size of the canvas
			//ctx.fillRect(-this.width * 0.25, -this.height * 0.25, this.width, this.height);

            var bgWidth = -this.width * 0.25;
            while (bgWidth < this.width) {
                var bgHeight = -this.height * 0.25;
                while (bgHeight < this.height) {
                    ctx.drawImage(background, bgWidth, bgHeight);
                    bgHeight += background.height;
                }

                bgWidth += background.width;
            }

			//ctx.fillRect(-canvas.width * 0.5, -canvas.height * 0.5, this.width, this.height);
			
			// Render effects
			var i = fx.length;
			while(i--) {
				fx[i].render();
			}
			
			// Render doodads
			var j = doodads.length;
			while(j--) {
				doodads[j].render();
			}
		},
		clear: function() {
			canvas.width = canvas.width;
			
			// Clears effects
			var i = fx.length;
			while(i--) {
				fx[i].clear();
			}
			
			// Clears doodads
			var j = doodads.length;
			while(j--) {
				doodads[j].clear();
			}
		}
	};
};