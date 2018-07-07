jQuery(document).ready(function(){
    'use strict';
 
    jQuery("body").queryLoader2({
        onComplete: function() {},
        onLoadComplete: function() {},
        backgroundColor: "#fff",
        barColor: stag_loader.stag_bcolor,
        overlayId: 'qLoverlay',
        barHeight: 2,
        percentage: false,
        deepSearch: true,
        completeAnimation: "fade",
        minimumTime: 800    
    });

    jQuery("#qLoverlay").fadeOut(700);  
});