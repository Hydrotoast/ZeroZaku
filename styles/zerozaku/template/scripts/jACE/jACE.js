var jACE = {};
(function(_) {
    _.init = function() {
        _.initGameVariables();
        _.initEventHandlers();

        setInterval(_.render, 1000 / $.FPS);
    };

    _.initGameVariables = function() {
        nodeCanvas = document.getElementById('jaceNode');
        nodeCtx = nodeCanvas.getContext('2d');

        var relative = $.findPos(nodeCanvas);
        nodeCanvasMinX = relative.x;
        nodeCanvasMaxX = nodeCanvasMinX + nodeCanvas.width;

        nodeCanvasMinY = relative.y;
        nodeCanvasMaxY = nodeCanvasMinY + nodeCanvas.height;

         // Initialize variables and other stuff
        room = new Room('jaceRoom');
        room.addDoodad(new Rock(room.getCtx(), 0, 0));
        room.addDoodad(new Rock(room.getCtx(), room.width * 0.5, room.height * 0.5));

        localplayer = new Node();
        nodes.push(localplayer);
        
        viewport = new Viewport(.1, .5, .75, localplayer, 1.75, 800);
    };

    _.initEventHandlers = function() {
        GUI.initEventHandlers();

        mouse = new Mouse();
        keyboard = new Keyboard();

        nodeCanvas.onclick = function(evt) {
            mouse.x = Math.round(evt.pageX - nodeCanvasMinX) + room.ox;
            mouse.y = Math.round(evt.pageY - nodeCanvasMinY) + room.oy;

            var dx = mouse.x - localplayer.x;
            var dy = mouse.y - localplayer.y;
            localplayer.angle = Math.atan2(dy, dx);

            mouse.moving = true;
            localplayer.thrust = false;
            localplayer.reverse = false;
        };
    };

    _.render = function() {
        viewport.clear();
        viewport.update();
        viewport.render();
    };
})(jACE);