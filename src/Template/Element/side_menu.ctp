<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?php
        $role = $this->request->getSession()->read('Auth.User.role');
        $param = $this->request->getParam('controller');
        $action = $this->request->getParam('action');
        // debug($param);
        // debug($action);die();
        // debug($role);die();
        if ($role == 'admin'){
        ?>
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Users'), ['controller' => 'users', 'action' => 'index']) ?></li>
            <?php if ($param == 'Users' && $action == 'index') { ?>
                <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
            <?php } ?>
            <li class="heading"><?= $this->Html->link(__('Article'), ['controller' => 'articles', 'action' => 'index']) ?></li>
            <?php if ($param == 'Articles' && $action == 'index') { ?>
                <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
            <?php } ?>
            <li class="heading"><?= $this->Html->link(__('Search'),['controller' => 'articles', 'action' => 'searchform']) ?></li>
            <li class="heading"><?= $this->Html->link(__('Message'), ['controller' => 'messages', 'action' => 'index']) ?></li>
            <?php if ($param == 'Messages' && $action == 'index') { ?>
                <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('Messages'), ['action' => 'index']) ?></li>
            <?php } ?>

        <?php } else{?>

            <li class="heading"><?= __('Actions') ?></li>
            <li class="<?php if($param == 'Articles' && $action == 'searchform') {echo 'active';} ?>"><?= $this->Html->link(__('Search'),['controller' => 'articles', 'action' => 'searchform']) ?></li>
            <li class="<?php if($param == 'Articles' && $action == 'index') {echo 'active';} ?>"><?= $this->Html->link(__('Article'), ['controller' => 'articles', 'action' => 'index']) ?></li>
            <li class="<?php if($param == 'Articles' && $action == 'latestArticle') {echo 'active';} ?>"><?= $this->Html->link(__('Latest Article'), ['controller' => 'articles', 'action' => 'latestArticle']) ?></li>
            <?php if ($param == 'Articles' && $action == 'index') { ?>
                <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
            <?php } ?>
         <?php } ?>

        
        
    </ul>
</nav>