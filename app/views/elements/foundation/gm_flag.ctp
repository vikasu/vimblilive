
<ul>
  <li>
      <!--Sub Menu Content Starts-->
      <section class="innerexpand" id="nobgbox">
        <?php echo $this->element("message/errors");?>
        <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>

           <ul class="missin-flds missionview biolist">
              <li><h3 class=wrdspcn>Set &nbsp<span>Parameters</span></h3>
              <li><div style="border:2px solid black;margin-bottom:20px"><p style="margin: 11px;">
                         The color of the flags will change based on the status of the activate parameters<br/>
                         RED: When NO Mission active<br/>
                          YELLOW: When Mission = Y, and any of the other selected parameters out of spec<br/>
                          GREEN: Mission = Y, and all selected parameters are in place
             </p></div></li>
               <?php /* Bio Section starts  */
                echo $this->Form->create('FlagSetting', array('url'=>array('controller' => 'users','action' => 'manage_flag'))); 
          ?>
               <li>
                    <div style="width: 35px; padding-top:10px; float:left"><input type="checkbox" disabled="disabled" checked="checked"></div>
                    <div style="width: 150px; float:left;padding-top:10px;">Active Mission</div>
               </li>
               <li>
                    <div><?php echo $this->Form->input('FlagSetting.active_sponsor_check',array('type'=>'checkbox','label'=>false)); ?>
                    <?php echo $this->Form->hidden('FlagSetting.id');?>
                    </div>
                    <div>Active Sponsor</div>
               </li>
               <li>
                    <div><?php echo $this->Form->input('FlagSetting.days_remaining_check',array('type'=>'checkbox','label'=>false)); ?></div>
                    <div style="float: left; width:370px">Mission days remaining MORE than (days)</div>
                    <div class=textbox><span><?php echo $this->Form->input('FlagSetting.days_remaining',array('placeholder'=>'Days remaining','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
               </li>
               <li>
                    <div><?php echo $this->Form->input('FlagSetting.last_reflection_check',array('type'=>'checkbox','label'=>false)); ?></div>
                    <div style="float: left;width:370px;">Last reflection older than (days) </div>
                    <div class=textbox><span><?php echo $this->Form->input('FlagSetting.last_reflection',array('placeholder'=>'last reflection','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
               </li>
               <li>
                    <div><?php echo $this->Form->input('FlagSetting.total_reflection_check',array('type'=>'checkbox','label'=>false)); ?></div>
                    <div style="float: left;width:370px;">Total reflections for the past 30 days fewer than (days)</div>
                    <div class=textbox><span><?php echo $this->Form->input('FlagSetting.total_reflection_in_30_days',array('placeholder'=>'total reflection in 30 days','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'value'=>'0')); ?></span></div>
               </li>
              
               <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>     
            </ul>    
      </section><HR>
      

    </li>  
      <!--Sub Menu Content End-->
 
  
               