<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Simple Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="<?php echo $this->Url->build('/webroot/css/styles.css') ?>" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href='//fonts.googleapis.com/css?family=Dosis:400,300,200,500,600,700,800' rel='stylesheet' type='text/css'>
<!-- //web font -->
</head>
<body>
  <!-- main -->
  
  <div class="main">
    <?= $this->Flash->render() ?>
    <h1>Login Form</h1>
    <div class="main-row">
      <div class="agileits-top"> 
        <?= $this->Form->create() ?>
          <input class="text" type="text" name="username" placeholder="Username" required>
          <input class="text" type="password" name="password" placeholder="Password" required>
          <input type="submit" value="LOGIN">
          <p>Feel free to <a href="<?php echo $this->Url->build('/users/add') ?>">Register</a></p>
        <p><a href="<?php echo $this->Url->build('/users/forgotpassword') ?>">Forgot Password</a></p>

      </div>
      <?= $this->Form->end() ?>   
    </div>  
    <!-- copyright -->
    <div class="copyright">
      <p> © 2018 All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">Project</a></p>
    </div>
    <!-- //copyright -->
  </div>  
  <!-- //main --> 
</body>
</html>

<!-- <div class="users form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div> -->