<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    ?>
<script type="text/javascript">
 jQuery(function() {
    $('#star').raty({
      cancel    : false,
      cancelOff : 'cancel-off-big.png',
      cancelOn  : 'cancel-on-big.png',
      half      : false,
      size      : 24,
      starHalf  : 'star-half-big.png',
      starOff   : 'star-off-big.png',
      starOn    : 'star-on-big.png',
      number: 3,
      scoreName: 'data[Mission][sp_complete_rating]',
      score : '<?php echo isset($rating) ? $rating : ''; ?>',
      path : '<?php echo SITE_URL; ?>/img'
    });
    });
 </script>   
<style>
    #star{
        width: 130px !important;
    }
    #notes{
           border: 1px solid #ccc;
           height: 30px;
           width: 279px;
    }
    #rating1{
        border: 1px solid #ccc;
        margin-left: 7px;
    }
    input[type="submit"]{
            border: 1px solid #999999;
            cursor: pointer;
            font-style: bold;
            margin-top: 15px;
            padding: 6px;
            
            
    }
    #submit{
        height: 39px !important;
        width: 87px !important; 
    }
    
</style>
<?php //pr($id);?>
<?php echo $this->Form->create('Mission',array('controller'=>'mission','action'=>'mission_completed/'.base64_encode($id).'/'.$_SESSION['Auth']['User']['id']));?>

        <div style="width: 100px">Closing Notes:</div><?php echo $this->Form->input('sp_complete_note',array('type'=>'text','label'=>false,'id'=>'notes'));?><br>
        <div style="width: 50px">Rating:</div><div id="star"></div> 
        <?php //echo $form->submit('Submit', array('type'=>'image','src' => 'img/submit.png'));  ?><br>
  <?php //echo $this->Form->button('Submit',array('type'=>'submit','id'=>'submit'));?>
  <?php echo $this->Form->submit('/img/submit.png',array('id'=>'submit')); ?><br>
  Completing the mission will
  remove the mission from the active list.
 


