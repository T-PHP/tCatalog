<?php
use Core\Language;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <h1> <?php echo Language::show('Welcome', 'Home'); ?> </h1>
        </div>
    </div>
</div>


<?php $hooks->run('homeCenter'); ?>