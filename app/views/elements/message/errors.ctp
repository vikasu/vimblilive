<div id="receiver">
 <?php if(isset($validationErrorsArray)){ ?>
 <div class="error">
                <div class="errorTopheadingText">
                                Oops something went wrong. Here is what you can do:
                </div>
                <div id="receiver" class="errorlist">
                    <ol>
                        <?php foreach($validationErrorsArray as $key=>$value): ?>			        <li><?php echo __($value); ?></li>
                        <?php endforeach;?>
                    </ol>
                </div>
 </div>
 <?php } ?>

 <?php if(isset($errors)){ ?>
 <div class="error">
                <div class="errorTopheadingText">
                       Oops something went wrong. Here is what you can do:
                </div>
                <div id="receiver" class="errorlist">
                    <ol>
                       <?php
                       foreach($errors as $error_list):
                         foreach($error_list as $v): ?>
                                <li><?php echo __($v)?></li>
                         <?php endforeach;
                       endforeach;
                       ?>
                    </ol>
                </div>
 </div>
 <?php } ?>
</div>