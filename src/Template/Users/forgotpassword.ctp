

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
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
    <h1>Forgot Password</h1>
    <div class="main-row">
      <div class="agileits-top"> 
        <?= $this->Form->create() ?>
          <input class="text" type="text" name="mail" placeholder="Email" required>
          <input type="submit" value="SEND">
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