<?php
use Core\Language;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            LEFT COLUMN
        </div>
        <div class="col-xs-12 col-md-9">
            <h1 class="title-page"><?php echo $data['category'][0]->name; ?></h1>
            
            <?php if(!empty($data['category'][0]->short_description)): ?>
                <?php echo $data['category'][0]->short_description; ?>
            <?php endif; ?>
            
            
            <?php if(!empty($data['sub_categories'])): ?>
                <div class="sub-categories">
                    <span><?php echo Language::show('Sub-Categories', 'Categories'); ?></span>
                    <ul class="list-inline">
                    <?php foreach($data['sub_categories'] as $sub_categorie): ?>
                        <?php if($sub_categorie->id_category !=0): ?>
                            <li class="text-center">
                                <a class="" href="<?php echo DIR.URL_CATEGORY.$sub_categorie->id_category.'-'.$sub_categorie->url.'.html'; ?>" title="<?php echo $sub_categorie->name; ?>">
                                    <img src="https://dummyimage.com/100" class="img-responsive img-thumbnail"/>
                                    <span class="clearfix"></span>
                                    <?php echo $sub_categorie->name; ?>
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
                                <img src="http://keenthemes.com/assets/bootsnipp/k3.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a rel="nofollow" href="<?php echo DIR.LANGUAGE_CODE.'/p/'.$product->id_product.'-'.$product->url.'.html?quick-view=1'; ?>" class="btn modal-quick-view">
                                        <?php echo Language::show('Quick view', 'Categories'); ?>
                                    </a>
                                    <a href="#" class="btn">
                                        <?php echo Language::show('View', 'Categories'); ?>
                                    </a>
                                </div>
                              </div>
                              <h3><a href="<?php echo DIR.LANGUAGE_CODE.'/p/'.$product->id_product.'-'.$product->url.'.html'; ?>" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a></h3>
                              <div class="pi-price">$<?php echo $product->price; ?></div>
                              <a href="javascript:;" class="btn add2cart"><?php echo Language::show('Add to cart', 'Categories'); ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>  
                <?php else: ?>
                    <p class="alert alert-warning">
                        <?php echo Language::show('No product in this category', 'Categories'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="col-xs-12 text-right">
            <?php echo $data['pageLinks']; ?>
        </div>
        
    </div>
</div>


<div id="modalProduct" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo Language::show('Quick view', 'Categories'); ?></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Language::show('Close', 'Categories'); ?></button>
            </div>
        </div>
    </div>
</div>