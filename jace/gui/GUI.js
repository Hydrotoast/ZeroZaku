// Initialize on Game startup
var GUI = {
    speech: null,
    message: null,

    nodeConfig: null,
    nodeColor: null,

    initEventHandlers: function() {
        this.speech = document.getElementById('speech');
        this.message = document.getElementById('message');

        this.nodeConfig = document.getElementById('nodeConfig');
        this.nodeColor = document.getElementById('nodeColor');

        this.speech.onsubmit = function() {
            var messageValue = this.message.value;
            localplayer.addMessage(messageValue);
            Chatlog.addLog(username, messageValue);
            this.message.value = '';

            return false;
        };

        this.nodeConfig.onsubmit = function() {
            var color = this.nodeColor.value;
            localplayer.setColor(color);
            this.nodeColor.value = '';

            return false;
        };
    }
};