/**
 * Created by darkwolf on 27.11.2016.
 *
 * Main Site Code for modern browsers, loaded async through inline.js
 */
import {doc, win} from './globals';
import ready from './event/domready';
import mainmenu from './component/mainmenu';

µ.ready(function() {
    console.log("Site Code startet");
    mainmenu.init();
});



