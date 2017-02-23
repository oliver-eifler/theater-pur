/**
 * Created by darkwolf on 27.11.2016.
 *
 * Main Site Code for modern browsers, loaded async through inline.js
 */
import {doc, win} from './globals';
import actionObserver from './event/action-observer'
import mainmenu from './component/mainmenu';
import lightbox from './component/lightbox';

actionObserver.bind("lightbox",function(event,node){
    var lb=lightbox();
    if (lb.create(node) === true) {
        lb.open();
        event.stopPropagation();
        event.preventDefault();
    }
});
µ.ready(function() {
    console.log("Site Code startet");
    mainmenu.init();
});



