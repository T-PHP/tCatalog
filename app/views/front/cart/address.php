<?php
use Core\Error;
use Core\Language;
use Helpers\Form;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <h1><?= Language::show('Addresses', 'Cart'); ?></h1>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="well">
                <h4 id="delivery_address" class="text-uppercase"><?= Language::show('Delivery Address', 'Cart'); ?></h4>
                <?php foreach($data['delivery_addresses'] as $address): ?>
                    <p><?= $address->company; ?></p>
                    <p><?= $address->lastname; ?> <?= $address->firstname; ?></p>
                    <p><?= $address->address1; ?></p>
                    <p><?= $address->address2; ?></p>
                    <p><?= $address->postal_code; ?> <?= $address->city; ?></p>
                    <p><?= $address->phone; ?></p>
                    <p><?= $address->mobile_phone; ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="well">
                <h4 id="invoicing_address" class="text-uppercase"><?= Language::show('Invoicing Address', 'Cart'); ?></h4>
                <?php if (!empty($data['invoicing_addresses'])): ?>
                    <?php foreach($data['invoicing_addresses'] as $address): ?>
                        <p><?= $address->company; ?></p>
                        <p><?= $address->lastname; ?> <?= $address->firstname; ?></p>
                        <p><?= $address->address1; ?></p>
                        <p><?= $address->address2; ?></p>
                        <p><?= $address->postal_code; ?> <?= $address->city; ?></p>
                        <p><?= $address->phone; ?></p>
                        <p><?= $address->mobile_phone; ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center"><?= Language::show('Same as delivery address', 'Cart'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
