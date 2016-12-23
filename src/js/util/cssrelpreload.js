/*! CSS rel=preload polyfill. Depends on loadCSS function. [c]2016 @scottjehl, Filament Group, Inc. Licensed MIT  */
import {win} from '../globals';
import loadCSS from '../util/loadCSS';
  var rp = {};
  rp.support = function(){
    try {
      return win.document.createElement( "link" ).relList.supports( "preload" );
    } catch (e) {
      return false;
    }
  };

  // loop preload links and fetch using loadCSS
  rp.poly = function(){
    var links = win.document.getElementsByTagName( "link" );
    for( var i = 0; i < links.length; i++ ){
      var link = links[ i ];
      if( link.rel === "preload" && link.getAttribute( "as" ) === "style" ){
        loadCSS( link.href, link );
        link.rel = null;
      }
    }
  };

  // if link[rel=preload] is not supported, we must fetch the CSS manually using loadCSS
  if( !rp.support() ){
    rp.poly();
    var run = win.setInterval( rp.poly, 300 );
    if( win.addEventListener ){
      win.addEventListener( "load", function(){
        win.clearInterval( run );
      } );
    }
    if( win.attachEvent ){
      win.attachEvent( "onload", function(){
        win.clearInterval( run );
      } )
    }
  }
