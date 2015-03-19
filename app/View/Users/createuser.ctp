<?php 
    //các trường dữ liệu đăng ký tài khoản
    $repass=array('lastname','firstname','username','password','password_cf','email',
        'email_cf','tel_num');
    echo$this->Form->create('User'); 
 ?> 
<div class="createuser">
    <h3><?php echo Configure::read("$lang"."dangkytaikhoan.0");?>
        <span class="label label-danger">
            <?php echo Configure::read($lang."dangkytaikhoan.1");?>
        </span>
    </h3>
<?php
    //ngôn ngữ có địa chỉ bắt đầu từ 8 đến 24
    $i=2;
    foreach ($repass as $value){
        if($value=='password_cf'){
?>
        <div class="input-group">
            <?php echo$this->Form->input($value,array('class'=>'form-control',
                'placeholder'=>Configure::read($lang.'dangkytaikhoan.'.$i),
                'aria-describedby'=>'basic-addon2',
                'maxlength'=>'32','type'=>'password',
                'div'=>FALSE,'label'=>FALSE));
            ?>
            <span class="input-group-addon" id="basic-addon2"><?php
                echo Configure::read($lang.'dangkytaikhoan.'.($i+1));
                $i=$i+2;
            ?></span>
        </div>
<?php
        }else{
            
?>
    <div class="input-group">
        <?php echo$this->Form->input($value,array('class'=>'form-control',
            'placeholder'=>Configure::read($lang.'dangkytaikhoan.'.$i),'aria-describedby'=>'basic-addon2',
            'maxlength'=>'32',
            'div'=>FALSE,'label'=>FALSE));
        ?>
        <span class="input-group-addon" id="basic-addon2"><?php
            echo Configure::read($lang.'dangkytaikhoan.'.($i+1));
            $i+=2;
        ?></span>
    </div>
<?php
        }
    }
?>
</div>
<div class="text-center submit">
    <?php echo$this->Form->end(Configure::read($lang.'dangkytaikhoan.'."18")); ?>
</div>