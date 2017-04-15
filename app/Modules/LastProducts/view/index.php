<?php

use Core\Language;

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="module-title">Titre</div>
        </div>
        <?php if(!empty($data['last_products'])): ?>
            <?php foreach($data['last_products'] as $product): ?>
                <div class="col-md-3">
                    <div class="product-item">
                      <div class="pi-img-wrapper">
                        <img src="<?= DIR.URL_IMG_PRODUCT.$product->id_product.'/s-'.$product->image; ?>" class="img-responsive" alt="Berry Lace Dress">
                        <div>
                            <a rel="nofollow" href="<?= DIR.LANGUAGE_CODE.'/p/'.$product->id_product.'-'.$product->url.'.html?quick-view=1'; ?>" class="btn modal-quick-view">
                                <?= Language::show('Quick view', 'Categories'); ?>
                            </a>
                            <a href="#" class="btn">
                                <?= Language::show('View', 'Categories'); ?>
                            </a>
                        </div>
                      </div>
                      <h3><a href="<?= DIR.LANGUAGE_CODE.'/p/'.$product->id_product.'-'.$product->url.'.html'; ?>" title="<?= $product->name; ?>"><?= $product->name; ?></a></h3>
                      <div class="pi-price">$<?= number_format($product->price, 2); ?></div>
                      <a href="<?= DIR.LANGUAGE_CODE.'/cart?add='.$product->id_product; ?>" class="btn add2cart"><?= Language::show('Add to cart', 'Categories'); ?></a>
                    </div>
                </div>
            <?php endforeach; ?>  
        <?php else: ?>
            <p class="alert alert-warning">
                No Product
            </p>
        <?php endif; ?>
    </div>
</div>

<div id="modalProduct" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= Language::show('Quick view', 'Categories'); ?></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Language::show('Close', 'Categories'); ?></button>
            </div>
        </div>
    </div>
</div>
