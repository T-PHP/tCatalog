<?php
use Core\Language;
use Helpers\Hooks;

$hooks = Hooks::get();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <?php $hooks->run('columnLeft'); ?>
        </div>
        <div class="col-xs-12 col-md-9">
            <h1 class="title-page"><?= $data['category'][0]->name; ?></h1>
            
            <?php if(!empty($data['category'][0]->short_description)): ?>
                <?= $data['category'][0]->short_description; ?>
            <?php endif; ?>
            
            
            <?php if(!empty($data['sub_categories'])): ?>
                <div class="sub-categories">
                    <span><?= Language::show('Sub-Categories', 'Categories'); ?></span>
                    <ul class="list-inline">
                    <?php foreach($data['sub_categories'] as $sub_categorie): ?>
                        <?php if($sub_categorie->id_category !=0): ?>
                            <li class="text-center">
                                <a class="" href="<?= DIR.URL_CATEGORY.$sub_categorie->id_category.'-'.$sub_categorie->url.'.html'; ?>" title="<?= $sub_categorie->name; ?>">
                                    <img src="https://dummyimage.com/100" class="img-responsive img-thumbnail"/>
                                    <span class="clearfix"></span>
                                    <?= $sub_categorie->name; ?>
                                </a>
                            </li> 
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
                   
            <div class="row">
                <?php if(!empty($data['products'])): ?>
                    <?php foreach($data['products'] as $product): ?>
                        <div class="col-md-4">
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
                        <?= Language::show('No product in this category', 'Categories'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="col-xs-12 text-right">
            <?= $data['pageLinks']; ?>
        </div>
        
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