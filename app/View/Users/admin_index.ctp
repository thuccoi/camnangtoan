<!--index off users-->
<?php
    if(isset($user)){
        echo "Hello ".$user['username'];
        echo $this->Html->link('Logout',  array('action'=>'logout'));
    }