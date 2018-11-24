<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Register Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Simple Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--include jQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<!--include jQuery Validation Plugin-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>

<!--Optional: include only if you are using the extra rules in additional-methods.js -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<!-- Custom Theme files -->
<link href="<?php echo $this->Url->build('/webroot/css/styles.css') ?>" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href='//fonts.googleapis.com/css?family=Dosis:400,300,200,500,600,700,800' rel='stylesheet' type='text/css'>
<!-- //web font -->
<style type="text/css">
  .error{
      color:red;
     }
</style>
</head>
<body>
  <!-- main -->
  <?= $this->Flash->render() ?>
  <div class="main">

    <h1>Registration Form</h1>
    <div class="main-row">
      <div class="agileits-top" src="<?php echo $this->Url->build('/webroot/img/bg.jpg') ?>">
        <?= $this->Form->create($user,['id' => 'register' , 'type' => 'file' ]) ?>
          <input class="text" type="text" name="username" placeholder="Username" required>
          
          <input class="text" type="text" name="email" placeholder="Email" required>
          <input class="text" type="text" name="age" placeholder="Age" required>
          <br><br>
          Gender:
          <input type="radio" name="gender" value="female">Female
          <input type="radio" name="gender" value="male">Male
          <input type="radio" name="gender" value="other">Other
          <br><br>
          <?= $this->Form->input('img_name', ['type' => 'file']);?>
          <input class="text" type="password" name="password" placeholder="Password" required>
          <br><br>
          <?= $this->Form->control('role', [
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
          <input type="submit" value="REGISTER">
      </div>
      <?= $this->Form->end() ?>   
    </div>  
    <!-- copyright -->
    <div class="copyright">
      <p> © 2018 Easy Register Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">Project</a></p>
    </div>
    <!-- //copyright -->
  </div>  
  <!-- //main --> 

<script type="text/javascript">
    jQuery.validator.addMethod("lettersonly", function(value, element)
          {
              return this.optional(element) || /^[a-z]+$/i.test(value);
          }, "Letters only please");
    $(function()
        {
          //validate signup form on keyup and submit
          $("#register").validate({
            rules: {
              username:{
                required: true,
                lettersonly:true
              },
              email:{
                required: true,
                email: true
              },
              gender:{
                  required: true
              },
              /*messages: {
                name :"PLease enter your name",
                website :"please enter website",
                email:"PLease enetr your email"
              }*/
            }
          });
        });
</script>
</body>
</html>

<!--  <div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->control('role', [
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div> -->
