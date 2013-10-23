<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<?php echo $javascript->link('admins/pageedit.js');?>
<?php include(WWW_ROOT.'js'.DS.'fckeditor'.DS.'fckeditor.php'); ?>

<?php echo $this->Form->create('Admin',array('name'=>'editcms','id'=>'editcms'));?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
	<td>
  		<img src="/img/spacer.gif" width="1" height="10" alt="" />
    </td>
 </tr>
 <tr>
 	<td>
 			<div>
			   <?php echo $session->flash(); ?>	
			</div> 
 	
 	</td>
 </tr>
 
 <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
        		<td class="left_title">Edit Page:
	        	    <div class="rightclass">
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
        		<td style="width: 185px;" align="left" valign="top"><label>Page Title *: </label></td>
        		<td>	
        			<?php echo $this->Form->input('Cmspage.id');?>
        			<?php echo $this->data['Cmspage']['page_title'];
						  echo $this->Form->input('Cmspage.page_title',array('type'=>'hidden'));?>
				</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentCity">Content Type  :</label></td>
        		<td><?php 
		        		echo $this->Form->input('Cmspage.content_type',array('div'=>false,'label'=>false,'class'=>'width200'));
        			?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentState">Meta Title :</label></td>
        		<td>
        			<?php echo $this->Form->input('Cmspage.meta_title',array('div'=>false,'label'=>false,'class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentCountry">Meta Description :</label></td>
        		<td>
					<?php echo $this->Form->input('Cmspage.meta_description',array('div'=>false,'label'=>false,'class'=>'width200'));?>        		
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentZip">Meta Keyword :</label></td>
        		<td>
					<?php echo $this->Form->input('Cmspage.meta_keyword',array('div'=>false,'label'=>false,'class'=>'width200'));?>        		
        		</td>
       	     </tr>
      	      <tr>
        		<td align="left" valign="top">
        			<label for="UserBioEmploymentGender">Position :</label>
				</td>
        		<td>		
					<div>
							<input type="radio" name="data[Cmspage][link_pos]" id = 'header' <?php if(isset($this->data) && ($this->data['Cmspage']['link_pos'] == '1')){echo "checked";}  ?> value="1"> Header
							<input type="radio" name="data[Cmspage][link_pos]" id = 'footer' <?php if(isset($this->data) && ($this->data['Cmspage']['link_pos'] == '2')){echo "checked";}  ?> value="2"> Footer
							<input type="radio" name="data[Cmspage][link_pos]" id = 'both' <?php if(isset($this->data) && ($this->data['Cmspage']['link_pos'] == '3')){echo "checked";}  ?> value="3"> Both
					</div>
				</td>
      	     </tr>
       	     
       	     <tr>
        		<td align="left" valign="top">
        			<label for="UserBioEmploymentGender">Status :</label>
				</td>
        		<td>		
					<div>
							<input type="radio" name="data[Cmspage][cms_status]" id = 'active' <?php if(isset($this->data) && ($this->data['Cmspage']['cms_status'] == '1')){echo "checked";}  ?> value="1"> Publish
							<input type="radio" name="data[Cmspage][cms_status]" id = 'inactive' <?php if(isset($this->data) && ($this->data['Cmspage']['cms_status'] == '0')){echo "checked";}  ?> value="0"> Unpublish
					</div>
				</td>
      	     </tr>
      	     
      	     
      	     
      	     <tr>
        		<td align="left" valign="top" colspan="2"><label for="UserBioEmploymentZip">Content :</label></td>
			 </tr>
			 <tr>	
        		<td align="left" valign="top" colspan="2">
					<?php //echo $this->Form->input('Cmspage.content',array('div'=>false,'label'=>false,'type'=>'textarea','class'=>'width200'));?>        		
				<?php	
					$oFCKeditor = new FCKeditor('data[Cmspage][content]','CmspageContent') ;
					$oFCKeditor->BasePath	= '/js/fckeditor/';
					$oFCKeditor->Width		= '100%' ;
					$oFCKeditor->Height		= '300' ;
					$oFCKeditor->Value		= $this->data['Cmspage']['content'] ;
					$oFCKeditor->Create() ;		
				?>	
        		</td>
       	     </tr>
       	     
			<!--<tr>
        		<td align="left" valign="top">
        			<label for="UserBioEmploymentGender">Link Manager :</label>
				</td>
        		<td>		
				<div> -->
						<?php //echo $this->Form->select('Cmspage.link_mgr',$this->requestAction('/commons/linkMgrList'),null,array('div'=>false,'label'=>false,'empty'=>'0','class'=>'width200'));?>
		    <!-- </div>
				</td>
      	     </tr> -->

			  <tr>
      	      	<td></td>
      	      </tr>
      	     <tr>
        		<td></td>
        		<td>
        			<input type="submit" value="Update" class="button" style="width:80px;"/>
        	    	<div class="buttonEnding rightclass"></div>
					&nbsp;&nbsp;        	    	
	        	    <input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/pagelist'"/>
	        	    <div class="buttonEnding rightclass"></div>
        			<?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      	     
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>