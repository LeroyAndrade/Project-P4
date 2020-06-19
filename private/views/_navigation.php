<!--private/includes/functions.php
current_route_is()  bekijkt of de route waar je nu op bent, of dat de route is met de $name parameter,  returns zijn booleans  
-->
<ul>
    <li>
        <a href="<?php echo url( 'home' ) ?>"<?php if ( current_route_is( 'home' ) ): ?> class="active"<?php endif ?>>Home</a>
    </li>

    <li>
        <a href="<?php echo url( 'register.form' ) ?>"<?php if ( current_route_is( 'register.form' ) ): ?>class="" <?php endif ?>>Registreer</a>
    </li>

        <li>
        <a href="<?php echo url( 'register.form' ) ?>"<?php if ( current_route_is( 'register.form' ) ): ?>class="" <?php endif ?>>Registreer</a>
    </li>

        <li>
        <a href="<?php echo url( 'winkelpagina' ) ?>"<?php if ( current_route_is( 'winkelpagina' ) ): ?>class="" <?php endif ?>>Winkelpagina</a>
    </li>
</ul>