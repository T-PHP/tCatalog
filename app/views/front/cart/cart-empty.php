<?php
use Core\Language;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <h1><?= Language::show('Cart', 'Cart'); ?></h1>
            <p><?= Language::show('Your cart is empty', 'Cart'); ?></p>
        </div>
        <div class="col-xs-12 col-md-3">
            Right Column
        </div>
    </div>
</div>
