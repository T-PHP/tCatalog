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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php echo Error::display($data['error']); ?>
        </div>
        <?php echo Form::open($params = array('method'=>'post')); ?>
        <div class="col-xs-12 col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('General', 'Products'); ?></h3>
            </div>
                <div class="box-body">
                    <div class="form-group col-md-6 p0 pright5">
                      <label for="name"><?php echo Language::showAdmin('Name', 'Products'); ?></label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo Language::showAdmin('Name', 'Products'); ?>">
                    </div>
                    <div class="form-group col-md-6 p0 pleft5">
                      <label for="sku"><?php echo Language::showAdmin('SKU', 'Products'); ?></label>
                      <input type="text" class="form-control" name="sku" id="sku" placeholder="<?php echo Language::showAdmin('Sku', 'Products'); ?>">
                    </div>
                    <div class="form-group">
                      <label for="short_description"><?php echo Language::showAdmin('Short Description', 'Products'); ?></label>
                      <textarea id="short_description" name="short_description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="long_description"><?php echo Language::showAdmin('Long Description', 'Products'); ?></label>
                      <textarea id="long_description" name="long_description" class="form-control"></textarea>
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
                                <option value="<?php echo $category->id_category; ?>"><?php echo $category->name; ?></option>
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
                        <div class="form-group">
                          <label for="price"><?php echo Language::showAdmin('Price', 'Products'); ?></label>
                          <input type="text" class="form-control" name="price" id="price" placeholder="<?php echo Language::showAdmin('Price', 'Products'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="price_tax"><?php echo Language::showAdmin('Taxes', 'Products'); ?></label>
                            <select class="form-control" id="price_tax" name="price_tax">
                                <option value="">5.00%</option>
                                <option value="">20.00%</option>
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
                          <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="<?php echo Language::showAdmin('Title', 'Products'); ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_description"><?php echo Language::showAdmin('Meta Description', 'Products'); ?></label>
                          <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="<?php echo Language::showAdmin('Meta Description', 'Products'); ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_robots"><?php echo Language::showAdmin('Meta Robots', 'Products'); ?></label>
                            <select class="form-control" id="meta_robots" name="meta_robots">
                                <?php foreach($data['meta_robots'] as $meta_robots): ?>
                                    <option value="<?php echo $meta_robots->id_meta_robots; ?>"><?php echo $meta_robots->content; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                    <button type="submit" name="submit" class="btn btn-primary"><?php echo Language::showAdmin('Save', 'Products'); ?></button>
                </div>
            </div><!-- /.box SEO -->
        </div><!-- /.col -->
        <?php echo Form::close(); ?>
      </div>
      <!-- /.row -->
    </section>
</div>