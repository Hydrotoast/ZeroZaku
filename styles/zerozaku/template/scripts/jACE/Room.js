/* Initializes the room and all objects within the room including all players or nodes
 * 
 */
var Room = function() {
	// The damn list of people
	var nodes = new Array();
	var background = null;

	return {
		addNode: function(node) {
			// Add people to the room
			node.id = nodes.length;
			nodes.push(node);
		},
		display: function(){
			
		}
	};
};