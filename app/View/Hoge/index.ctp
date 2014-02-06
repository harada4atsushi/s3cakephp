<?php echo $this->Form->create('Hoge', array('action' => 'update', 'type' => 'file')); ?>
<?php echo $this->Form->input('upfile', array('type' => 'file')); ?>
<?php echo $this->Form->submit('アップロード'); ?>
<?php echo $this->Form->end() ?>

<?php echo $this->Form->create('Hoge', array('action' => 'putHtml', 'type' => 'file')); ?>
<?php echo $this->Form->submit('このHTMLを保存する'); ?>
<?php echo $this->Form->end() ?>
