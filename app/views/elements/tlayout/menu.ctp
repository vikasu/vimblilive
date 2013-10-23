<section class="hot_products">
            
            <ul>
                <?php if($this->Session->read('Auth.User.id')!='') {?>
                
                <li class="common"><?php echo $html->link('List Event','/events/eventlist',array('alt'=>'List Event','style'=>'','class'=>'')); ?></li>
                
                <li class="common"><?php echo $html->link('Add Event','/events/add_event',array('alt'=>'Add Event','style'=>'','class'=>'')); ?></li>
                
                <?php } ?>
                <li class="common"><a href="#">Sub Menu 1</a></li>
                <li class="common"><a href="#">Sub Menu 2</a></li>
                <li class="common"><a href="#">Sub Menu 3</a></li>
                <li class="common"><a href="#">Sub Menu 4</a></li>
                <li class="common"><a href="#">Sub Menu 5</a></li>
            </ul>
        </section>