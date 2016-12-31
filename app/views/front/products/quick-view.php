<?php
use Core\Language;
?>

<div class="card">
    <div class="container-fliud">
        <div class="wrapper row">
            <div class="preview col-xs-12 col-md-6">

                <div class="preview-pic tab-content">
                  <div class="tab-pane active" id="pic-1"><img src="http://placekitten.com/400/252" /></div>
                  <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/401/252" /></div>
                  <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/402/252" /></div>
                  <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/403/252" /></div>
                  <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/404/252" /></div>
                </div>
                <ul class="preview-thumbnail nav nav-tabs">
                  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                  <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                  <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                  <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                  <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                </ul>

            </div>
            <div class="details col-xs-12 col-md-6">
                <h1 class="product-title"><?php echo $data['product'][0]->name; ?></h1>
                <div class="rating">
                    <div class="stars">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <span class="review-no">41 <?php echo Language::show('reviews', 'Products'); ?></span>
                </div>
                <p class="product-description"><?php echo $data['product'][0]->short_description; ?></p>
                <h4 class="price"><?php echo Language::show('Current Price', 'Products'); ?> : <span>$<?php echo $data['product'][0]->price; ?></span></h4>
                <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                <h5 class="sizes">sizes:
                    <span class="size" data-toggle="tooltip" title="small">s</span>
                    <span class="size" data-toggle="tooltip" title="medium">m</span>
                    <span class="size" data-toggle="tooltip" title="large">l</span>
                    <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                </h5>
                <h5 class="colors">colors:
                    <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                    <span class="color green"></span>
                    <span class="color blue"></span>
                </h5>
                <div class="action">
                    <button class="add-to-cart btn btn-default" type="button"><?php echo Language::show('Add to cart', 'Products'); ?></button>
                    <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                </div>
            </div>
        </div>
        <div class="wrapper row">
            <div class="col-md-12">
                <?php if(!empty($data['product'][0]->long_description)): ?>
                <div class="long-description">
                    <h2><?php echo Language::show('Long Description', 'Products'); ?></h2>
                    <?php echo $data['product'][0]->long_description; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>