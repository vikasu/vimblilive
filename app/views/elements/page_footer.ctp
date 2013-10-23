<footer>
	<div class="ftr_links">
		<?php $i=1; $countHeader = count($footerPageDetails);?>
    	<?php foreach($footerPageDetails as $footerPageDetails)
    	{?>
    		<a href="/pages/<?php echo $footerPageDetails['Cmspage']['page_title'];?>" title="<?php echo $footerPageDetails['Cmspage']['content_type'];?>">
    			<?php echo ucfirst($footerPageDetails['Cmspage']['content_type']);?>
    		</a> 
    	<?php if($i<$countHeader) {?>/<?php }?>
    	<?php $i++;}?>
		<p>&copy; 2012 vimbli.</p>
	</div>
	<div class="ftr_logo">
		<a href="#" title=""></a>
	</div>
</footer>


