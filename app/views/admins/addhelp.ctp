<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php 
 	//echo $javascript->link('users/signup.js');
 	//pr($this->data);
?>

<?php //include(WWW_ROOT.'js'.DS.'fckeditor'.DS.'fckeditor.php'); ?>

<?php echo $this->Form->create('Admin',array('name'=>'addhelp','id'=>'addhelp'));?>
<?php echo $this->Form->input('Help.help_cat_id',array('type'=>'hidden','value'=>$catid));?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
	<td>
  		<img src="/img/spacer.gif" width="1" height="10" alt="" />
    </td>
 </tr>
 <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
        		<td class="left_title">Add Help Topic:
	        	    <div class="rightclass">
	        	    	<input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/helpcatlist'"/>
	        	    	<div class="buttonEnding rightclass"></div>
	        	    </div>	
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
      	     <tr>
        		<td align="left" valign="top"><label>Help Topic *: </label></td>
        		<td align="left" valign="top">
					<?php echo $this->Form->input('Help.help_topic',array('div'=>false,'label'=>false,'type'=>'textarea','class'=>'width200'));?>        		
				
        		</td>
       	     </tr>
      	     
      	      <tr>
      	      	<td></td>
      	      </tr>
      	     <tr>
      	     	<td></td>
        		<td align="left" valign="top">
        			<input type="submit" value="Save" class="button" style="width:80px;"/>
        	    	<div class="buttonEnding rightclass"></div>
        			<?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>