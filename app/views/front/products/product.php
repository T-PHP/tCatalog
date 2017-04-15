<?php
use Core\Language;
?>

<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <?php if(!empty($data['images'])): ?>
                        <div class="preview-pic tab-content">
                         <?php foreach($data['images'] as $image): ?>
                            <div class="tab-pane <?php if($image === reset($data['images'])): echo 'active'; endif; ?>" id="pic-<?= $image->id_product_image; ?>">
                                <img src="<?= DIR.URL_IMG_PRODUCT.$image->id_product.'/s-'.$image->image; ?>" />
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                          <?php foreach($data['images'] as $image): ?>
                            <li <?php if($image === reset($data['images'])): echo 'class="active"'; endif; ?>>
                                <a data-target="#pic-<?= $image->id_product_image; ?>" data-toggle="tab">
                                    <img src="<?= DIR.URL_IMG_PRODUCT.$image->id_product.'/s-'.$image->image; ?>" />
                                </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1">
                                <img src="https://dummyimage.com/600x600/ffffff/000000&text=No+Image" />
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="details col-md-6">
                    <h1 class="product-title"><?= $data['product'][0]->name; ?></h1>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 <?= Language::show('reviews', 'Products'); ?></span>
                    </div>
                    
                    <!-- Brand -->
                    <?php if(!empty($data['product'][0]->brand_name)): ?>
                        <p>
                            <strong><?= Language::show('Brand', 'Products'); ?> : </strong><?= $data['product'][0]->brand_name; ?>
                        </p>
                    <?php endif; ?>
                    <!-- End Brand -->
                    
                    <!-- Short Description -->
                    <p class="product-description">
                        <?= $data['product'][0]->short_description; ?>
                    </p>
                    <!-- End Short Description -->
                    
                    <form class="form-horizontal">
                        <div class="price"><?= Language::show('Current Price', 'Products'); ?> : <span>$<?= number_format($data['product'][0]->price, 2); ?></span></div>
                        <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                        
                        <!-- Attributes -->
                        <?php foreach($data['attributes_groups'] as $attribute_group): ?>
                            <div class="form-group">
                                <label class="attribute-label col-sm-2 control-label" for="<?= $attribute_group['id_attribute_group']; ?>"><?= $attribute_group['group_name']; ?></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="<?= $attribute_group['id_attribute_group']; ?>">
                                    <?php foreach($attribute_group['attribute'] as $attribute): ?>
                                        <option value="<?= $attribute['id_attribute']; ?>"><?= $attribute['name']; ?></option>

                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- End Attributes -->
                        
                        <div class="action">
                            <a href="<?= DIR.URL_CART.'?add='.$data['product'][0]->id_product; ?>" class="add-to-cart btn btn-default"><?= Language::show('Add to cart', 'Products'); ?></a>
                            <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Long Description -->
            <div class="wrapper row">
                <div class="col-md-12">
                    <?php if(!empty($data['product'][0]->long_description)): ?>
                    <div class="long-description">
                        <h2><?= Language::show('Long Description', 'Products'); ?></h2>
                        <?= $data['product'][0]->long_description; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Long Description -->
       
            
        </div>
    </div>
</div>