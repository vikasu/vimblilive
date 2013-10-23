<?php //pr($this->data);?>
<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<?php echo $javascript->link('admins/editfaq.js');?>
<?php $id = $this->data['Faq']['id'];?>

<?php echo $this->Form->create('Admin',array('name'=>'addfaq','id'=>'addfaq','action'=>"/editfaq/$id"));?>
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
        		<td class="left_title">Add FAQ:
	        	    
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
      	     <tr>
        		<td align="left" valign="top" style="width:150px;"><label>FAQ Question *: </label></td>
				<td>      	     
					<?php   echo $this->Form->input('Faq.id',array('type'=>'hidden','value'=>$this->data['Faq']['id']));
							echo $this->Form->input('Faq.faq_que',array('div'=>false,'label'=>false,'type'=>'textarea','class'=>'width200'));?>        		
					<?php //echo $this->Form->error('Help.faq_que');?>	
				
        		</td>
       	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label>FAQ Answer *: </label></td>
      	   		<td align="left" valign="top">
					<?php echo $this->Form->input('Faq.faq_ans',array('div'=>false,'label'=>false,'type'=>'textarea','class'=>'width200'));?>        		
					<?php //echo $this->Form->error('Faq.faq_ans');?>	
				
        		</td>
       	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label>Priority *: </label></td>
      	   		<td align="left" valign="top">
					<?php echo $this->Form->select('Faq.priority',$this->requestAction("/commons/priorityList"),null,array('div'=>false,'empty'=>'Select','label'=>false,'type'=>'textarea','class'=>'width200'));?>        		
					<?php echo $this->Form->error('Faq.priority');?>	
				
        		</td>
       	     </tr>
      	     
      	      <tr>
      	      	<td></td>
      	      	<td></td>
      	      </tr>
      	     <tr>
      	     	<td></td>
        		<td align="left" valign="top">
        				<input type="submit" value="Save" class="button" style="width:80px;"/>
	        	    	<div class="buttonEnding rightclass"></div>
	        	    	&nbsp;&nbsp;
	        	    	<input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/faqlist'"/>
	        	    	<div class="buttonEnding rightclass"></div>
	        	    	
        			
        			<?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>