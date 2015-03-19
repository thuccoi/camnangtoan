<form method="post">
<?php
    echo $this->Form->input('lang', array(
        'options' => array('tiengviet.'=>'Tiếng việt','tienganh.'=>'English'
        ),
        'div'=>FALSE,'label'=>FALSE
    ));
?>
    <span class="glyphicon glyphicon-refresh"><input type="submit" class="glyphicon glyphicon-refresh"/></span>
</form>
<?php
if(isset($_POST['lang']))
{
        $lang=$_POST['lang'];
        debug($lang);
}
 ?>

