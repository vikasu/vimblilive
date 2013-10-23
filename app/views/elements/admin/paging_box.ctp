<?php
 $model_name = $this->params['models'][0] ;
?>
<div class="paging_full_numbers" id="example_paginate">
<?php  if($paginator->numbers()){
  
	echo $paginator->first('First', array('class'=>"homeLink"));echo '&nbsp;&nbsp;';
	echo $paginator->prev('Previous',array('class'=>"disabled"));  echo '&nbsp;&nbsp;';
	echo $paginator->numbers(array('separator'=>'')); echo '&nbsp;&nbsp;';
	echo $paginator->next('Next',array('class'=>"disabled")); echo '&nbsp;';
	echo $paginator->last('Last',array('class'=>"homeLink"));
	//echo $paginator->counter(array(	'format' => 'Page %page% of %pages% ' ));
}
	
?> 
	&nbsp;
</div>