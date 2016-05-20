//console.log('the silence is golden...');

// enter konami code!
var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
jQuery(document).keydown(function(e) {

  kkeys.push( e.keyCode );

  if ( kkeys.toString().indexOf( konami ) >= 0 ) {

    jQuery(document).unbind('keydown',arguments.callee);
    
    // do something awesome
    jQuery("body").prepend("<h1 style='font-family: comic; padding-top: 200px; color: salmon;'>Meeeow.</h1>");
  
  }

});