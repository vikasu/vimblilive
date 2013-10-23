<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
 <script>
 
 </script>
  <section class="innerexpand">
    <ul  style="list-style:none;">
	<?php /* Bio Section starts
	        echo $this->Form->create('', array('action' => 'settings/index/'.base64_encode($_SESSION['Auth']['User']['id']),'id'=>'signUpForm', 'name'=>'signUpForm')); ?>
	*/ ?>
	<form id="core_values_listing" action="<?php echo SITE_URL.'settings/index/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
	 
	 <li><?php echo $this->Form->checkbox('CoreValue.1',array('value'=>'Achievement','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Achievement</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.2',array('value'=>'Advancement And Promotion','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Advancement And Promotion</label>
	</li>
	 
	<li><?php echo $this->Form->checkbox('CoreValue.3',array('value'=>'Adventure','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Adventure</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.4',array('value'=>'Affection(love and caring)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Affection(love and caring)</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.5',array('value'=>'Arts','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Arts</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.6',array('value'=>'Challenging Problems','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Challenging Problems</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.7',array('value'=>'Change and variety','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Change and variety</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.8',array('value'=>'Close relationships','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Close relationships</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.9',array('value'=>'Community','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Community</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.10',array('value'=>'Competence','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Competence</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.11',array('value'=>'Competition','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Competition</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.12',array('value'=>'Cooperation','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Cooperation</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.13',array('value'=>'Country','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Country</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.14',array('value'=>'Creativity','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Creativity</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('CoreValue.15',array('value'=>'Decisiveness','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Decisiveness</label>
	</li>
	<li><?php echo $this->Form->checkbox('CoreValue.16',array('value'=>'Democracy','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
	<label>Democracy</label>
	</li>
	
	<li>
	<div class=signuplogin-btn><?php echo $this->Form->end('Select',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
						    
	 
	 
	 </ul>
</section>