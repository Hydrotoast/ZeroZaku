/**
 * Displays a select region of the room and handles interactions with respect to the room
 * @param k frequency of camera shifts
 * @param ox
 * @param oy
 * @param target node to follow
 * @param tight
 * @param viewport
 * @return
 */
function Viewport(k, ox, oy, target, tight, viewport) {
	var x = target.x,
		y = target.y,
		z = target.z;
		angle = target.angle
	var model_viewport = viewport;
	
	var push_matrix = function() {	
		room.getCtx().save();
			// with respect to the room
			room.getCtx().translate(room.width * 0.5, room.height * 0.5); // Center room to camera
			room.getCtx().translate(-x, -y); // Move inverse to point
			room.getCtx().scale(this.z, this.z);
		
		nodeCtx.save();
			nodeCtx.translate(nodeCanvas.width * 0.5, nodeCanvas.height * 0.5);
			nodeCtx.translate(this.x, this.y);
			nodeCtx.scale(this.z, this.z);
	};
	
	return {
		update_size: function(size) {
		},
		clear: function() {
			room.clear();
			
			var i = nodes.length;
			while(i--) {
				nodes[i].clear();
			}
		},
		update: function() {
			// Update camera position
			x += (target.x - x) * k;
			y += (target.y - y) * k;
			
			// Offset from room
			room.ox = (x - nodeCanvas.width * 0.5);
			room.oy = (y - nodeCanvas.height * 0.5);
			
			z += (target.z - z) * k;
			angle += (target.angle - angle) * k;
			
			room.update(x, y); // Update the room
			
			// Update each Player
			var i = nodes.length;
			while(i--) {
				nodes[i].update();
			}
		},
		render: function() {
			// Clear the 
		    nodeCanvas.width = nodeCanvas.width;
			
		    push_matrix();
		    
			room.render(); // draws the room
			
			// Draw Each Player
			var i = nodes.length;
			while(i--) {
				nodes[i].update();
				nodes[i].render();
			}
		}
	};	
}