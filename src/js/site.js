/**
 * Created by darkwolf on 27.11.2016.
 *
 * Main Site Code for modern browsers, loaded async through inline.js
 */
import actionObserver from './event/action-observer'
import mainmenu from './component/mainmenu';

actionObserver.bind("lightbox",function(event,node){
    node.classList.toggle("lightbox");
    event.stopPropagation();
    event.preventDefault();

});
µ.ready(function() {
    console.log("Site Code startet");
    mainmenu.init();
});



