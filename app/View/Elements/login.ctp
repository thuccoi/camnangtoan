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
<div class="box-login">
    <?php
        echo $this->Form->create('User', array(
            'url' => array(
                'controller' => 'users',
                'action' => 'login'
            )
        ));
    ?>
    <div class="row">
        <div class="col-lg-4">
            
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-xs-4">

                </div>
                <div class="col-xs-4">
                    <div class="input-group input-group1 input-group-sm" >
                      <span class="input-group-addon alert-info">Mời bạn nhập:</span>
                      <?php
                            echo $this->Form->input('User.username',array('class'=>'form-control',
                              'placeholder'=>'Tên tài khoản','maxlength'=>'32',
                              'div'=>FALSE,'label'=>FALSE
                            ));
                      ?>
                  </div>
                </div><!-- /.col-xs-4 -->
                <div class="col-xs-4">
                  <div class="input-group input-group-sm">
                      <?php
                            echo $this->Form->input('User.password',array('class'=>'form-control',
                                'placeholder'=>'Mật khẩu','maxlength'=>'32',
                                'div'=>FALSE,'label'=>FALSE
                            ));
                      ?>
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">Đăng nhập</button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-xs-4 -->
            </div><!-- /.row -->
            <div class="text-right">
                <ol class="breadcrumb">
                    <li><a href="users/passmail">Quên mật khẩu?</a></li>
                    <li><a href="#">Tạo tài khoản mới</a></li>
                </ol>
            </div>
        </div>
    </div>
    </form>
</div>
<?php
    }
?>