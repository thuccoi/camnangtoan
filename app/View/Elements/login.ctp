<?php
    //log in
    if(isset($user)){
?>
<div class="row">
    <div class="col-xs-9">
    </div>
    <div class="col-xs-3">
        <h5 class="text-primary">
            <span class="glyphicon glyphicon-user">
               
            </span>
             <?php
                echo " ".$user['lastname']." ".$user['firstname']." ";
            ?>
            <a href="users/logout">
                <span class="glyphicon glyphicon-log-out">
                </span>
            </a>
        </h5>
    </div>
</div>
        
<?php
    }else{
?>
<?php
        echo $this->Form->create('User', array(
            'url' => array(
                'controller' => 'users',
                'action' => 'login'
            )
        ));
?>
<div class="box-login">
    <div class="row">
        <div class="col-lg-5">
        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-4">
                    <div class="input-group input-group1 input-group-sm" >
                      <span class="input-group-addon"><?php echo Configure::read($lang."dangnhap.0");?></span>
                      <?php
                            echo $this->Form->input('User.username',array('class'=>'form-control',
                              'placeholder'=>Configure::read($lang."dangnhap.1"),'maxlength'=>'32',
                              'div'=>FALSE,'label'=>FALSE
                            ));
                      ?>
                  </div>
                </div><!-- /.col-xs-4 -->
                <div class="col-xs-4">
                  <div class="input-group input-group-sm">
                      <?php
                            echo $this->Form->input('User.password',array('class'=>'form-control',
                                'placeholder'=>Configure::read($lang."dangnhap.2"),'maxlength'=>'32',
                                'div'=>FALSE,'label'=>FALSE
                            ));
                      ?>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><?php echo Configure::read($lang."dangnhap.3");?></button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-xs-4 -->
            </div><!-- /.row -->
            <div class="text-right">
                <ol class="breadcrumb">
                    <li><a href="users/passmail"><?php echo Configure::read($lang."dangnhap.4");?></a></li>
                    <li><a href="users/createuser"><?php echo Configure::read($lang."dangnhap.5");?></a></li>
                </ol>
            </div>
        </div>
    </div>
    </form>
</div>
<?php
}
   
?>