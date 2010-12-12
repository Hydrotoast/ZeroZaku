var Room = function() {
	// The damn list of people
	this.nodes = new Array();
};

Room.prototype.addNode = function(node) {
	// Add people to the room
	node.id = this.nodes.length;
	this.nodes.push(node);
};

Room.prototype.display = function(){
	// Loop through each user and display them
	for(var i in this.nodes) {
		this.nodes[i].display();
	}
};