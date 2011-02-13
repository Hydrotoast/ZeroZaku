var Chatlog = {
	logs: [],
    
    addLog: function(p_node, p_message) {
        this.logs.push({username: p_node, messsage: p_message});
        var li = document.createElement('li');
        var strong = document.createElement('strong');
        strong.appendChild(document.createTextNode(p_node + ': '));
        li.appendChild(strong);
        li.appendChild(document.createTextNode(p_message));
        document.getElementById('jaceChatlog').appendChild(li.cloneNode(true));
    },

    getLogs: function()  {
        console.log(logs);
    }
};