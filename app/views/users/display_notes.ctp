
<style>
    #notes{
           border: 1px solid #ccc;
           height: 30px;
           width: 279px;
    }
    input[type="submit"]{
            border: 1px solid #999999;
            cursor: pointer;
            font-style: bold;
            margin-top: 15px;
            padding: 6px;
            height: 39px !important;
            width: 87px !important;
            
    }
     #submit{
        height: 39px !important;
        width: 87px !important; 
    }
</style>
<?php //pr($id);?>
    <?php echo $this->Form->create('Mission',array('controller'=>'mission','action'=>'mission_completed/'.base64_encode($id).'/'.$_SESSION['Auth']['User']['id'].'/'.'2'));?>
    <div style="width: 100px">Notes:</div><?php echo $this->Form->input('Mission.sp_note',array('type'=>'text','label'=>false,'id'=>'notes'));?><br>  
     <?php echo $this->Form->submit('/img/submit.png',array('id'=>'submit')); ?><br>
    


