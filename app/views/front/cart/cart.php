<?php
use Core\Language;
use Helpers\Form;
use Helpers\Session;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <?php echo Session::message('message');?>
            <h1><?= Language::show('Cart', 'Cart'); ?></h1>
            <?= Form::open($params = array('method'=>'post')); ?>
            <table class="table table-responsive table-striped table-hover table-bordered">
                <tbody>
                    <tr>
                        <th><?= Language::show('Item', 'Cart'); ?></th>
                        <th><?= Language::show('Qty', 'Cart'); ?></th>
                        <th><?= Language::show('Unit Price', 'Cart'); ?></th>
                        <th><?= Language::show('Total Price', 'Cart'); ?></th>
                        <th><?= Language::show('-', 'Cart'); ?></th>
                    </tr>
                    <?php foreach($data['products'] as $product): ?>
                        <tr>
                            <td><?= $product->name; ?></td>
                            <td id="qty">
                                <input type="number" name="cart[qty][<?= $product->id_product; ?>]" id="qty" class="form-control" style="width: 45px; padding: 5px;" value="<?= $_SESSION['cart'][$product->id_product]; ?>">
                            </td>
                            <td id="price"><?= number_format($product->price, 2); ?></td>
                            <td id="price_sub"><?= number_format($product->price*$_SESSION['cart'][$product->id_product], 2); ?></td>
                            <td id="price_sub"><a href="<?= DIR.URL_CART.'?del='.$product->id_product; ?>"><i class="fa fa-trash"></i> </a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="3">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-refresh"></i> <?= Language::show('Recalculate', 'Cart'); ?>
                            </button>
                            <span class="pull-right"><?= Language::show('Sub Total', 'Cart'); ?></span>
                        </th>
                        <th id="subtotal"><?= number_format($data['sub_total_cart'], 2); ?></th>
                    </tr>
                    <tr>
                        <th colspan="3"><span class="pull-right"><?= Language::show('Shipping', 'Cart'); ?></span></th>
                        <th id="shipping"></th>
                    </tr>
                    <tr>
                        <th colspan="3"><span class="pull-right"><?= Language::show('Total', 'Cart'); ?></span></th>
                        <th id="total"></th>
                    </tr>
                    <tr>
                        <td><a href="<?= DIR.LANGUAGE_CODE; ?>" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> <?= Language::show('Continue Shopping', 'Cart'); ?></a></td>
                        <td colspan="3"><a href="<?= DIR.URL_CART.'/address'; ?>" id="checkout" class="pull-right btn btn-success"><?= Language::show('Checkout', 'Cart'); ?></a></td>
                    </tr>
                </tbody>
            </table>
            <?= Form::close(); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            Right Column
        </div>
    </div>
</div>


