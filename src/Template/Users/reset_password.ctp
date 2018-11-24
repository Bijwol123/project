<?
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>

<div class="articles form large-5 medium-8 columns content">
    <?= $this->Form->create('') ?>
    <fieldset>
        <?php
            echo $this->Form->control('New password', ['type' => 'password']);
            echo $this->Form->control('confirm password', ['type' => 'password']);
            ?>
    </fieldset>
    <?= $this->Form->button(__('change')) ?>
    <?= $this->Form->end() ?>
</div>