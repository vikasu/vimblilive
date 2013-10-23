function(jQuery){
   
    jQuery.fn.chrismap = function(e){
     var ex = {width:'330',height:'150',min:'10',max:'30'};
     var $this = jQuery(this);
     var Olib = jQuery.extend(ex,e);
        $this.attr("src","http://chart.apis.google.com/chart?chs="+Olib.width+"x"+Olib.height+"&cht=p3&chd=t:"+Olib.min+","+Olib.max);
    }   

});