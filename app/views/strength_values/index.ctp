<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    //pr($stValArr); 
    ?>
 <script>
 $(document).ready(function(){
 
 
   $(":checkbox").click(function(){
 var n = $(".st_vals:checked" ).length;
 if(n>7){
    $(this).prop("checked","");
 
 alert('You Can Only Select Seven Strengths');
 }
   
	
  
   
   
  });
        
    

   
    
 
  
  
    
  });
    
 
 </script>
 <STYLE>
 h1, h2, h3, h4, h5, h6, label {
    font-weight: normal;
    line-height: normal;
    margin-top: 5px;
}
    div.qtip-wrapper{
	
   
    width:550px;
	
	overflow:visible;
    }
     div.qtip qtip-defaults qtip-active{
    width:100%;
    z-index:100%;
    
   }
   div.qtip-contentWrapper{
    width:550px;
     z-index:100%;
   }
   div.qtip-content qtip-content{
     width:452px;
     z-index:100%;
   }
   .innerexpand1{
    width:170%;
   }
  </STYLE>
 <?php
 //pr($stValArr);die;
    $Creativity = (in_array('Creativity',$stValArr))?'checked':'';
    
    $Curiosity = (in_array('Curiosity',$stValArr))?'checked':'';
    $Openmindedness = (in_array('Open-mindedness',$stValArr))?'checked':'';
    $Loveoflearning = (in_array('Love of learning',$stValArr))?'checked':'';
    $Perspective = (in_array('Perspective(wisdom)',$stValArr))?'checked':'';
    $Bravery = (in_array('Bravery(valor)',$stValArr))?'checked':'';
    $Persistence = (in_array('Persistence',$stValArr))?'checked':'';
    $Integrity = (in_array('Integrity',$stValArr))?'checked':'';
    $Vitality = (in_array('Vitality',$stValArr))?'checked':'';
    $Love = (in_array('Love',$stValArr))?'checked':'';
    $Kindness = (in_array('Kindness',$stValArr))?'checked':'';
    $SocialIntelligence = (in_array('Social Intelligence',$stValArr))?'checked':'';
    $Citizenship = (in_array('Citizenship',$stValArr))?'checked':'';
    $Creativity = (in_array('Creativity',$stValArr))?'checked':'';
    $Fairness = (in_array('Kindness',$stValArr))?'checked':'';
    $Leadership = (in_array('Leadership',$stValArr))?'checked':'';
    $Forgiveness = (in_array('Forgiveness and mercy',$stValArr))?'checked':'';
    $Creativity = (in_array('Creativity',$stValArr))?'checked':'';
    $Humility = (in_array('Humility / Modesty',$stValArr))?'checked':'';
    $Prudence = (in_array('Prudence',$stValArr))?'checked':'';
    $Selfregulation = (in_array('Self-regulation',$stValArr))?'checked':'';
    $Appreciation = (in_array('Appreciation of beauty and excellence',$stValArr))?'checked':'';
    $Gratitude = (in_array('Gratitude',$stValArr))?'checked':'';
    $Hope  = (in_array('Hope ',$stValArr))?'checked':'';
    $Humor = (in_array('Humor',$stValArr))?'checked':'';
    $Spirituality = (in_array('Spirituality',$stValArr))?'checked':'';
    
 ?>
 
  <section class="innerexpand1">
  

    <form id="strength_values_listing" action="<?php echo SITE_URL.'settings/index/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
    <ul  style="list-style:none;">
	 <li>Understanding your strengths is very important. Sometimes finding the right words to<br> decribe your strengths is a struggle.  The list below could provide some prompts.</li><br>
	 <li>Select 7 strengths from the list or write your own:</li></ul>
	<h3><u><b>WISDOM & KNOWLEDGE: </b>Use of knowledge</u></h3> <ul>
	 <li><?php echo $this->Form->checkbox('StrengthValue.1',array('value'=>'Creativity','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Creativity)); ?></span></div>
	<label>Creativity [originality, ingenuity]</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.2',array('value'=>'Curiosity','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Curiosity)); ?></span></div>
	<label>Curiosity [interest, novelty-seeking, openness to experience]</label>
	</li>
	 
	<li><?php echo $this->Form->checkbox('StrengthValue.3',array('value'=>'Open-mindedness','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Openmindedness)); ?></span></div>
	<label>Open-mindedness [judgment, critical thinking]</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.4',array('value'=>'Love of learning','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Loveoflearning)); ?></span></div>
	<label>Love of learning</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.5',array('value'=>'Perspective(wisdom)','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Perspective)); ?></span></div>
	<label>Perspective [wisdom]</label>
	</li></ul>
	<h3><u><b>COURAGE: </b>Accomplish goals</u></h3> <ul>
	<li><?php echo $this->Form->checkbox('StrengthValue.6',array('value'=>'Bravery(valor)','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>$Bravery)); ?></span></div>
	<label>Bravery [valor]</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.7',array('value'=>'Persistence','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Persistence)); ?></span></div>
	<label>Persistence [perseverance,industriousness]</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.8',array('value'=>'Integrity','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>$Integrity)); ?></span></div>
	<label>Integrity [authenticity, honesty]</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.9',array('value'=>'Vitality','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Vitality)); ?></span></div>
	<label>Vitality [zest, enthusiasm, vigor, energy]</label>
	</li>
	</ul>
	<h3><u><b>HUMANITY: </b> Get involved with others</u></h3> <ul>
	<li><?php echo $this->Form->checkbox('StrengthValue.10',array('value'=>'Love','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Love)); ?></span></div>
	<label>Love</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.11',array('value'=>'Kindness','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Kindness)); ?></span></div>
	<label>Kindness [generosity, nurturance, care, compassion, altruistic love, niceness]</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.12',array('value'=>'Social Intelligence','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$SocialIntelligence)); ?></span></div>
	<label>Social Intelligence [emotional intelligence, personal intelligence]</label>
	</li>
	<h3><u><b>JUSTICE: </b>Enable a healthy community</u></h3> <ul>
	<li><?php echo $this->Form->checkbox('StrengthValue.13',array('value'=>'Citizenship','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Citizenship)); ?></span></div>
	<label>Citizenship [social responsibility, loyalty, teamwork]</label>
	</li>
	
	
	
	<li><?php echo $this->Form->checkbox('StrengthValue.15',array('value'=>'Fairness','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Fairness)); ?></span></div>
	<label>Fairness</label>
	</li>
	<li><?php echo $this->Form->checkbox('StrengthValue.16',array('value'=>'Leadership','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Leadership)); ?></span></div>
	<label>Leadership</label>
	</li></ul>
	<h3><u><b>TEMPERANCE: </b>Protect against excess</u></h3> <ul>
	<li><?php echo $this->Form->checkbox('StrengthValue.17',array('value'=>'Forgiveness and mercy','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Forgiveness)); ?></span></div>
	<label>Forgiveness and mercy</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.18',array('value'=>'Humility / Modesty','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Humility)); ?></span></div>
	<label>Humility / Modesty</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.19',array('value'=>'Prudence','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Prudence)); ?></span></div>
	<label>Prudence</label>
	</li>
	<li><?php echo $this->Form->checkbox('StrengthValue.20',array('value'=>'Self-regulation','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Selfregulation)); ?></span></div>
	<label>Self-regulation [self-control]</label>
	</li></ul>
	
	<h3><u><b>TRANSCENDANCE: </b>Connect to the larger universe</u></h3> <ul>
	<li><?php echo $this->Form->checkbox('StrengthValue.21',array('value'=>'Appreciation of beauty and excellence','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'checked'=>@$Appreciation)); ?></span></div>
	<label>Appreciation of beauty and excellence [awe, wonder, elevation]</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.22',array('value'=>'Gratitude','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Gratitude)); ?></span></div>
	<label>Gratitude</label>
	</li>
	
	<li><?php echo $this->Form->checkbox('StrengthValue.23',array('value'=>'Hope','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Hope)); ?></span></div>
	<label>Hope [optimism, future-mindedness, future orientation]</label>
	</li>
	<li><?php echo $this->Form->checkbox('StrengthValue.24',array('value'=>'Humor','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Humor)); ?></span></div>
	<label>Humor [playfulness]</label>
	</li>
	<li><?php echo $this->Form->checkbox('StrengthValue.25',array('value'=>'Spirituality','div'=>false,'label'=>false,'class' =>'validate[required] st_vals','error'=>false,'checked'=>@$Spirituality)); ?></span></div>
	<label>Spirituality [religiousness, faith, purpose]</label>
	</li></ul><br>
	
	
	<li>
	<div class=signuplogin-btn><?php echo $this->Form->end('Select',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
						    
	 </ul>
</section>
