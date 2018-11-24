<!-- <div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create('') ?>
    <fieldset>
        <legend><?= __('Change Password') ?></legend>
        <?php
            echo $this->Form->control('oldpassword',['type' => 'password']);
            echo $this->Form->control('newpassword',['type' => 'password']);
            echo $this->Form->control('confirmpassword',['type' => 'password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Password')) ?>
    <?= $this->Form->end() ?>
</div> -->

<?
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>

<div class="articles form large-5 medium-8 columns content">
    <?= $this->Form->create('',['id' => 'myform']) ?>
    <fieldset>
        <?php
            echo $this->Form->control('old password', ['type' => 'password']);
            echo $this->Form->control('New password', ['type' => 'password','id' =>'newpassword']);
            echo $this->Form->control('confirm password', ['type' => 'password','id' =>'oldpassword']);
            ?>
    </fieldset>
    <?= $this->Form->button(__('change')) ?>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
    $("#myform").validate({
        rules: {
            newpassword: "required",
            confirm: {
                equalTo: "#newpassword"
            }
        }
    });


    
</script>