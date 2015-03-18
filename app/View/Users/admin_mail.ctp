<?php
    echo $this->Form->create('Mail');
    echo $this->Form->textarea('cofirm', array('id'=>'cofirm','class'=>'ckeditor'));
?>
<script>
    //height off editer
    CKEDITOR.replace("cofirm", { height:"600"});
</script>

<?php
    echo $this->Form->textarea('modifi', array('id'=>'modifi','class'=>'ckeditor'));
    echo $this->Form->end('save');
?>
<script>
    //height off editer
    CKEDITOR.replace("modifi", { height:"600"});
</script>