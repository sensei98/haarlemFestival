<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php require APPROOT . '/views/includes/navigation.php';?>
<section class = containerLogin>
  <article class = wrapperLogin>
    <form method="POST" action="sendEmail">
      <p>Enter Email Address To Send Password Link</p>
      <input type="email" name="email">
      <input type="submit" name="submit_email">
    </form>
    
  </article>
</section>