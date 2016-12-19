/**
 * Created by darkwolf on 19.12.2016.
 */
/* a command queue for async script execution
adapted from google analystics command queue
*/
var OlliQueue = function () {
    this.push = function () {
        for (var i = 0; i < arguments.length; i++) try {
            if (typeof arguments[i] === "function") arguments[i]();
            else {
                // get tracker function from arguments[i][0]
                // get tracker function arguments from arguments[i].slice(1)
                // call it!  trackers[arguments[i][0]].apply(trackers, arguments[i].slice(1));
            }
        } catch (e) {
        }
    }
};
export default function() {
    var commandQueue = [];
    return function (cmd) {
        if (cmd === true) {
            /* execute all command in queue */
            console.log("queue: execute");
            var oldCommandQueue = commandQueue;
            // create a new _gaq object
            commandQueue = new OlliQueue();
            // execute all of the queued up events - apply() turns the array entries into individual arguments
            commandQueue.push.apply(commandQueue, oldCommandQueue);
        } else if (cmd) {
            /* add command to queue */
            commandQueue.push(cmd);
            console.log("queue: add command: " + cmd);
        }
    }
}
