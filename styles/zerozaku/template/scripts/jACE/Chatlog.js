var Chatlog = function() {
	var chatlog = document.getElementById('jaceChatlog');
	var logs = new Array();
	
	return {
		addLog: function(p_node, p_message) {
			logs.push({ username: p_node, messsage: p_message});
			var li = document.createElement('li');
			var strong = document.createElement('strong');
			strong.appendChild(document.createTextNode(p_node + ': '));
			li.appendChild(strong);
			li.appendChild(document.createTextNode(p_message));
			chatlog.appendChild(li.cloneNode(true));
		},
		getLogs: function()  {
			console.log(logs);
		}
	};
};