/* Initializes the room and all objects within the room including all players or nodes
 * 
 */
var Room = function(canvasId) {
	var canvas = document.getElementById(canvasId);
	var ctx = canvas.getContext('2d');
	
	var relative = findPos(canvas);
	var canvasMinX = relative.x;
    var canvasMaxX = canvasMinX + canvas.width;
	
    var canvasMinY = relative.y;
    var canvasMaxY = canvasMinY + canvas.height;
    
	// The damn list of people
	var fx = new Array();
	var background = '#FFFFFF';

	return {
		getCtx: function() { return ctx; },
		// Add effects to the room
		addFx: function(p_fx) {
			fx.push(p_fx);
		},
		// Remove effects from the room
		removeFx: function(p_fx) {
			fx.splice(fx.indexOf(p_fx), 1);
		},
		update: function(){
			// Update effects
			var i = fx.length;
			while(i--) {
				fx[i].update();
			}
		},
		render: function() {
			ctx.clearRect(0, 0, canvas.width, canvas.height);
			ctx.fillStyle = background;
			ctx.fillRect(0, 0, canvas.width, canvas.height);
			
			// Render effects
			var i = fx.length;
			while(i--) {
				fx[i].render();
			}
		}
	};
};