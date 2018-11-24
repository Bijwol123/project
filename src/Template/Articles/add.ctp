<?php //debug($categories); die(); ?>
<h1>Add Article</h1>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
    </ul>
</nav> -->
<div class="users index large-9 medium-8 columns content">
<?php
    echo $this->Form->create($article);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
   	echo $this->Form->select('category_id',$categories,['empty' => '(choose category)']
    );
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>
</div>