<?php $this->layout('website')

//Als eerste: welke layout gebruikt deze view:
?>

<h1>Inschrijven</h1>
<p>Schrijf u snel in op de website!</p>


<!--Verstuur form naar de route, anders krijg je een foutmelding-->
<form action="<?php echo url("register.handle");?>" method="POST" class="login-form">   <!--zie: private/includes/route_helpers       function url($name = null, $parameters = null, $getParams = null ){
    kijkt of er een route is met de naam:  "register.handle"     en zet er de juiste url neer-->
  <div class="form-group">
    <label for="email">Email address</label>
    <!--input() , wanneer leeg, antwoord = null, en anders return eerder ingevoerde email adres-->
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo input('email'); ?>">
    <small id="emailHelp" class="form-text text-muted">Uw data is veilig bij ons
    </small>
    
        <!--//private/controllers/RegistrationController.php
        //als er een waarde zit in array error, dan toon je die-->
        <?php if (isset( $errors['email'] ) ): ?>
            <?php echo $errors['email'] ?>
        <?php endif; ?>
     <!-- echo $errors['email']; ?>   
     Undefined variable: errors in C:\xampp\htdocs\AMC\bap\periode4\NieuwPoging-MVC\registratie\private\views\register_form.php on line 24

      variabelen worden niet doorgegeven,  
      1: session_Start() of is dat tegenstrijdig met MVC?
      2: 
    -->


  </div>

  <div class="form-group">
    <label for="wachtwoord">Wachtwoord</label>
    <input type="password" class="form-control" id="wachtwoord" name="wachtwoord">

        <!--private/controllers/RegistrationController.php
        //als er een waarde zit in array  error, dan toon je die-->
    <?php if (isset( $errors['wachtwoord'] ) ): ?>
        <?php echo $errors['wachtwoord'] ?>
    <?php endif; ?>

  </div>

  <button type="submit" class="btn btn-primary">Registreren</button>
</form>