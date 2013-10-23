<script>
function deleteimage(name){   
     $.ajax({
        type: "POST",
        url: "/events/deleteimage/"+name,
        beforeSend: function(html) { // this happen before actual call
            $("#primaryimage").html('');
	    jQuery('#deleteMessage').show();
	    jQuery('#deleteMessage').fadeOut(10000);
        }        
      });
}
</script>


<style>
.tabmenu {
    left: 220px;
    line-height: 21px;
    position: absolute;
    top: 50px;
}
.accountinfo{
     top:0px;
}
</style>

<section style='margin-top:20px'>
<!-- Bootstrap CSS Toolkit styles -->
<!-- Bootstrap CSS Toolkit styles -->
<?php  echo $html->css("imageupload/bootstrap.min");   ?>

<!-- Generic page styles -->
<?php  //echo $html->css("imageupload/style");   ?>

<!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->

<?php  echo $html->css("imageupload/responsive.min");   ?>
<!-- Bootstrap CSS fixes for IE6 -->
<!-- Bootstrap Image Gallery styles -->

<?php  echo $html->css("imageupload/bootstrap-image-gallery.min");   ?>
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<?php  echo $html->css("imageupload/jquery.fileupload-ui");   ?>

<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]>
<?php   echo $javascript->link("imageupload/html5.js");  ?><![endif]-->
    <span id="primaryMessage" style="color:green;margin-left:21px;display:none;">Primary image has been set.</span>
    <span id="deleteMessage" style="color:green;margin-left:21px;display:none;">Image has been deleted.</span>
    
    <form id="fileupload" name="photoform" action="/events/ajaxedit/<?php echo $this->data['Event']['id'];?>" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7" style="width: 747px;">
                <!-- The fileinput-button span is used to style the file input field as button -->
              <span class="btn btn-success fileinput-button" style=" height: 17px;">
                   <!-- <i class="icon-plus icon-white"></i> -->
                   <span>Add files...</span>
                   <input type="file" name="files[]" multiple>
              </span>              
	      <input type="hidden" name="propertyid" value="" >
                <button type="submit" class="btn btn-primary start" style="margin-bottom: 19px; height: 26px; width: 120px;">
                    <!-- <i class="icon-upload icon-white"></i> -->
                    <span>Start Upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel"  style="margin-bottom: 19px; height: 26px; width: 130px;">
                    <!-- <i class="icon-ban-circle icon-white"></i> -->
                    <span>Cancel Upload</span>
                </button>
	    </div>
	    
	    <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%; " ></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
            <!-- The table listing the files available for upload/download -->
            <div class="span7"style="width: 94%;">
              <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
       
        <!-- The table listing the files available for upload/download -->
	<!-- <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table> -->
    </form>
    
    
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
<!-- The template to display files available for upload --> 
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td style="display:none;" class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
	       <div>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
		<div class="" style="width:200px;float:left;padding-top:3px;"> Message: <input type="text" name="name[{%=file.name%}]" style="width:133px;" />  </div>
	       </div>
            </td>
            
	    <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary" style="height: 24px;   
    width: 75px;">
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning" style="height: 23px; width: 80px;">
               <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td style="display:none;" class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file[0].thumbnail_url) { %}
                <img src="{%=file[0].thumbnail_url%}">
            {% } %}</td>
            <td class="name" style="width:190px;">
                {%=file.description%}
            </td>
            
        {% } %}
	  <td class="delete">
            <button class="btn btn-danger" style="height: 26px; width: 82px;" value="{%=file[0].name%}" onclick="deleteimage(this.value);">
                <span>{%=locale.fileupload.destroy%}</span>
            </button>
          </td>
	  
    </tr>
{% } %}
</script>
<!--
<button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" style="height: 23px; width: 82px;">
     <i class="icon-trash icon-white"></i>
     <span>{%=locale.fileupload.destroy%}</span>
</button>
-->
<!-- for select box add above input radio - <input type="checkbox" name="delete" value="1" class="del"> -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<?php echo $javascript->link("imageupload/jquery.ui.widget.js"); ?>

<!-- The Templates plugin is included to render the upload/download listings -->

<?php echo $javascript->link("imageupload/tmpl.min.js");    ?>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->

<?php echo $javascript->link("imageupload/load-image.min.js");    ?>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<?php echo $javascript->link("imageupload/canvas-to-blob.min.js");  ?>
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->

<?php echo $javascript->link("imageupload/bootstrap.min.js");  ?>

<?php echo $javascript->link("imageupload/bootstrap-image-gallery.min.js");  ?>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<?php echo $javascript->link("imageupload/jquery.iframe-transport.js");  ?>

<!-- The basic File Upload plugin -->
<?php echo $javascript->link("imageupload/jquery.fileupload.js");  ?>

<!-- The File Upload file processing plugin -->
<?php echo $javascript->link("imageupload/jquery.fileupload-fp.js");  ?>

<!-- The File Upload user interface plugin -->

<?php echo $javascript->link("imageupload/jquery.fileupload-ui.js");  ?>
<!-- The localization script -->

<?php echo $javascript->link("imageupload/locale.js");  ?>
<!-- The main application script -->

<?php echo $javascript->link("imageupload/main.js");  ?>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]>
          <?php echo $javascript->link("imageupload/jquery.xdr-transport.js");  ?>
<![endif]-->
</section>