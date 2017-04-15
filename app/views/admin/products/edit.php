<?php
use Core\Error;
use Core\Language;
use Helpers\Form;
use Helpers\Session;
?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo Language::showAdmin('Edit product', 'Products'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Products'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('Products', 'Products'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('Edit', 'Products'); ?></li>
      </ol>
    </section>
    
    <form method="post" enctype="multipart/form-data">
    <section class="content"><!-- Main content -->
      <div class="row">
        <div class="col-xs-12">
            <?php echo Session::message('message');?>
            <?php echo Error::display($error); ?>
        </div>
        <div class="col-xs-12 col-md-8">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('General', 'Products'); ?></h3>
              <div class="pull-right">
                <div class="form-group">
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio2" value="0" <?php if($data['product']['0']->status == 0): ?> checked <?php endif; ?>> Disable
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio3" value="1" <?php if($data['product']['0']->status == 1): ?> checked <?php endif; ?>> Enable
                    </label>
                </div>
              </div>
            </div>
                <div class="box-body">
                    <div class="form-group col-md-6 p0 pright5">
                      <label for="name"><?php echo Language::showAdmin('Name', 'Products'); ?></label>
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['product']['0']->name; ?>" required>
                    </div>
                    <div class="form-group col-md-6 p0 pleft5">
                      <label for="sku"><?php echo Language::showAdmin('SKU', 'Products'); ?></label>
                      <input type="text" class="form-control" name="sku" id="sku" value="<?php echo $data['product']['0']->sku; ?>">
                    </div>
                    <div class="form-group">
                        <label for="short_description"><?php echo Language::showAdmin('Short Description', 'Products'); ?></label>
                        <textarea id="short_description" name="short_description" class="form-control">
                          <?php echo $data['product']['0']->short_description; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="long_description"><?php echo Language::showAdmin('Long Description', 'Products'); ?></label>
                        <textarea id="long_description" name="long_description" class="form-control">
                        <?php echo $data['product']['0']->long_description; ?>
                      </textarea>
                    </div>
                </div>
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-12 col-md-4">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('Categories', 'Products'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                      <label for="category"><?php echo Language::showAdmin('Category', 'Products'); ?></label>
                        <select class="form-control" id="category" name="category">
                            <?php foreach($data['categories'] as $category): ?>
                                <option value="<?php echo $category->id_category; ?>" <?php if($category->id_category == $data['product']['0']->id_category): echo 'selected'; endif; ?> >
                                    <?php echo $category->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div><!-- /.box -->
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('Brands', 'Products'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                      <label for="brand"><?php echo Language::showAdmin('Brand', 'Products'); ?></label>
                        <select class="form-control" id="brand" name="brand">
                            <?php foreach($data['brands'] as $brand): ?>
                                <option value="<?php echo $brand->id_brand; ?>" <?php if($brand->id_brand == $data['product']['0']->id_brand): echo 'selected'; endif; ?> >
                                    <?php echo $brand->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div><!-- /.box -->
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('Prices', 'Products'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group col-md-6 p0 pright5">
                          <label for="price"><?php echo Language::showAdmin('Price', 'Products'); ?></label>
                          <input type="text" class="form-control" name="price" id="price" value="<?php echo $data['product']['0']->price; ?>">
                        </div>
                        <div class="form-group col-md-6 p0 pleft5">
                          <label for="price_with_taxes"><?php echo Language::showAdmin('Price with Taxes', 'Products'); ?></label>
                          <input type="text" class="form-control" name="price_with_taxes" id="price_with_taxes" value="">
                        </div>
                        <div class="form-group">
                            <label for="price_tax"><?php echo Language::showAdmin('Taxes', 'Products'); ?></label>
                            <select class="form-control" id="price_tax" name="price_tax">
                                <?php foreach($data['taxes'] as $tax): ?>
                                    <option value="<?php echo $tax->id_tax; ?>" <?php if($tax->id_tax == $data['product']['0']->id_tax): echo 'selected'; endif; ?> data-tax-rate="<?php echo $tax->rate; ?>">
                                        <?php echo $tax->name; ?> (<?php echo round($tax->rate,2); ?>%)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('SEO', 'Products'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="meta_title"><?php echo Language::showAdmin('Title', 'Products'); ?></label>
                          <input type="text" class="form-control" name="meta_title" id="meta_title" value="<?php echo $data['product']['0']->meta_title; ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_description"><?php echo Language::showAdmin('Meta Description', 'Products'); ?></label>
                          <input type="text" class="form-control" name="meta_description" id="meta_description" value="<?php echo $data['product']['0']->meta_description; ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_robots"><?php echo Language::showAdmin('Meta Robots', 'Products'); ?></label>
                            <select class="form-control" id="meta_robots" name="meta_robots">
                                <?php foreach($data['meta_robots'] as $meta_robots): ?>
                                    <option value="<?php echo $meta_robots->id_meta_robots; ?>" <?php if($meta_robots->id_meta_robots = $data['product']['0']->meta_robots): echo 'selected'; endif; ?>><?php echo $meta_robots->content; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="url"><?php echo Language::showAdmin('Url', 'Products'); ?></label>
                          <input type="text" class="form-control" name="url" id="url" value="<?php echo $data['product']['0']->url; ?>">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                    <button type="submit" name="editProduct" class="btn btn-block btn-primary"><?php echo Language::showAdmin('Save', 'Products'); ?></button>
                </div>
            </div><!-- /.box SEO -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </section>
    </form>
    
    <form method="post" enctype="multipart/form-data">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('Images', 'Products'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="images"><?php echo Language::showAdmin('Images', 'Products'); ?></label>
                            
                            <div class="btn btn-default btn-file">
                              <i class="fa fa-image"></i> <?php echo Language::showAdmin('Attachment', 'Products'); ?>
                              <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>
                        </div>
                    </div>
                    <p id="success-save-image" class="alert alert-success" style="display: none">
                        <?php echo Language::showAdmin('Images updated', 'Products'); ?>
                    </p>
                    <div class="">
                        <ul id="sortme" class="sortable ui-sortable">
                        <?php if(!empty($data['images'])): ?>
                            <p><?php echo Language::showAdmin('Drag & Drop to sort images order', 'Products'); ?></p>
                            <?php foreach($data['images'] as $image): ?>
                                    <li id="orderImage_<?php echo $image->id_product_image; ?>">
                                        <img src="<?php echo DIR.URL_IMG_PRODUCT.$image->id_product.'/s-'.$image->image; ?>" class="img-thumbnail img-responsive" />
                                    </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                       </ul>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                    <button type="submit" name="editProductImages" class="btn btn-primary"><?php echo Language::showAdmin('Save', 'Products'); ?></button>
                </div>
            </div><!-- /.box Images -->
        </div>
      </div>
    </section>
    </form>
    
    <form method="post">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('Attributes', 'Products'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <?php foreach($data['attributes_groups'] as $attribute_group): ?>
                           <strong><?php echo $attribute_group['group_name']; ?> :</strong> 
                            <?php foreach($attribute_group['attribute'] as $attribute): ?>
                                <?php echo $attribute['name']; ?>, 
                            <?php endforeach; ?>
                            <br>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <input type="text" name="id_attribute" placeholder="id_attribute" />
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                    <button type="submit" name="editProductAttributes" class="btn btn-primary"><?php echo Language::showAdmin('Save', 'Products'); ?></button>
                </div>
            </div><!-- /.box Images -->
        </div>
      </div>
    </section>
    </form>
    
</div>