<!--cấp lại mật khẩu-->
<div class="box-login">
    <?php
        echo $this->Form->create('passmail');
    ?>
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-xs-6">
                    <div class="input-group input-group1 input-group-sm" >
                      <span class="input-group-addon alert-info">Cấp lại mật khẩu:</span>
                      <?php
                            echo $this->Form->input('username',array('class'=>'form-control',
                              'placeholder'=>'Tên tài khoản','maxlength'=>'32',
                              'div'=>FALSE,'label'=>FALSE
                            ));
                      ?>
                  </div>
                </div><!-- /.col-xs-6 -->
                <div class="col-xs-6">
                  <div class="input-group input-group-sm">
                      <?php
                            echo $this->Form->input('mail',array('class'=>'form-control',
                                'placeholder'=>'Email lúc đăng ký','maxlength'=>'32',
                                'div'=>FALSE,'label'=>FALSE
                            ));
                      ?>
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">Gửi cho tôi</button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-xs-6 -->
            </div><!-- /.row -->
        </div>
        <div class="col-lg-3">
        </div>
    </div>
    </form>
</div>
