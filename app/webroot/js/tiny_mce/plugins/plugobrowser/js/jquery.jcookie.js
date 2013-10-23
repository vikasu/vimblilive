/*! 
* jCookie - jQuery Cookie Plugin v1.1
* Copyright 2011 Tom Ellis http://www.webmuse.co.uk
* Licensed under MIT License
* See http://www.webmuse.co.uk/license/
* Based on the jQuery Cookie Plugin by Klaus Hartl
*/
(function(a){a.cookie=function(e,h,l){var j,d=[],k,i,b={},c;d={expires:"",domain:"",path:"",secure:false};if(arguments.length===1){if(document.cookie&&document.cookie!==""){d=document.cookie.split(";");a.each(d,function(f,g){g=a.trim(g);if(g.substring(0,e.length+1)===e+"="){j=decodeURIComponent(g.substring(e.length+1));return false}})}return j}else{a.extend(b,d,a.cookie.settings,l);if(h===null){h="";b.expires=-1}d=b.path?"; "+b.path:"";k=b.domain?"; "+b.domain:"";i=b.expires?function(f){if(a.type(f.expires)===
"number"){c=new Date;c.setTime(c.getTime()+f.expires*864E5)}else if(a.type(f.expires)==="date")c=f.expires;else{c=new Date;c.setTime(c.getTime()+864E5)}return i="; expires="+c.toUTCString()}(b):"";b=b.secure?"; secure":"";document.cookie=e+"="+encodeURIComponent(h)+i+d+k+b;return document.cookie.indexOf(e)}};a.cookie.settings={expires:"",domain:"",path:"",secure:false};a.support.cookies=a.cookie("j_testcookie","value");a.support.cookies&&a.cookie("j_testcookie",null)})(jQuery);
