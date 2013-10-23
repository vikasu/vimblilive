<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php echo $javascript->link('admins/addhelpcat.js');?>

<?php echo $this->Form->create('Admin',array('name'=>'addhelpcat','id'=>'addhelpcat'));?>
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
        		<td class="left_title">Add Help Category:
	        	    	
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
        	<tr>
        		<td style="width: 185px;"><label>Help Category *: </label></td>
        		<td>	
        			<?php //echo $this->Form->input('Cmspage.id');?>
        			<?php echo $this->Form->input('Helpcategory.hc_name',array('div'=>false,'label'=>false,'class'=>'width200'));?></td>
      	     </tr>

      	     <tr>
        		<td>
        			<label for="UserBioEmploymentGender">Status :</label>
				</td>
        		<td>		
					<div>
							<input type="radio" name="data[Helpcategory][hc_status]" id = 'active' checked value="1"> Active
							<input type="radio" name="data[Helpcategory][hc_status]" id = 'inactive' value="0"> Inactive
					</div>
				</td>
      	     </tr>
      	      <tr>
      	      	<td></td>
      	      </tr>
      	     <tr>
        		<td></td>
        		<td>
        			<input type="submit" value="Submit" class="button" style="width:80px;"/>
        	    	<div class="buttonEnding rightclass"></div>
        	    	&nbsp;&nbsp;
        	    	<input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/helpcatlist'"/>
	        	    <div class="buttonEnding rightclass"></div>
	        	    
        			<?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      	     
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>