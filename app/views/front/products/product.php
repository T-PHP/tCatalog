<?php
use Core\Language;
?>

<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

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
                <div class="details col-md-6">
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
                    
                    <!-- Brand -->
                    <?php if(!empty($data['product'][0]->brand_name)): ?>
                        <p>
                            <strong><?php echo Language::show('Brand', 'Products'); ?> : </strong><?php echo $data['product'][0]->brand_name; ?>
                        </p>
                    <?php endif; ?>
                    <!-- End Brand -->
                    
                    <!-- Short Description -->
                    <p class="product-description">
                        <?php echo $data['product'][0]->short_description; ?>
                    </p>
                    <!-- End Short Description -->
                    
                    <form class="form-horizontal">
                        <div class="price"><?php echo Language::show('Current Price', 'Products'); ?> : <span>$<?php echo $data['product'][0]->price; ?></span></div>
                        <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                        
                        <!-- Attributes -->
                        <?php foreach($data['attributes_groups'] as $attribute_group): ?>
                            <div class="form-group">
                                <label class="attribute-label col-sm-2 control-label" for="<?php echo $attribute_group['id_attribute_group']; ?>"><?php echo $attribute_group['group_name']; ?></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="<?php echo $attribute_group['id_attribute_group']; ?>">
                                    <?php foreach($attribute_group['attribute'] as $attribute): ?>
                                        <option value="<?php echo $attribute['id_attribute']; ?>"><?php echo $attribute['name']; ?></option>

                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- End Attributes -->
                        
                        <div class="action">
                            <button class="add-to-cart btn btn-default" type="button"><?php echo Language::show('Add to cart', 'Products'); ?></button>
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
                        <h2><?php echo Language::show('Long Description', 'Products'); ?></h2>
                        <?php echo $data['product'][0]->long_description; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Long Description -->
       
            
        </div>
    </div>
</div>