<?php
use Core\Error;
use Core\Language;
use Helpers\Form;
use Helpers\Session;
?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo Language::showAdmin('Edit category', 'Categories'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Categories'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('Categories', 'Categories'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('Edit', 'Categories'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php echo Session::message('message');?>
            <?php echo Error::display($error); ?>
        </div>
        <?php echo Form::open($params = array('method'=>'post')); ?>
        <div class="col-xs-12 col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('General', 'Categories'); ?></h3>
              <div class="pull-right">
                <div class="form-group">
                    <label class="radio-inline">
                      <input type="radio" name="status" value="0" <?php if($data['category']['0']->status == 0): ?> checked <?php endif; ?>> Disable
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" value="1" <?php if($data['category']['0']->status == 1): ?> checked <?php endif; ?>> Enable
                    </label>
                </div>
              </div>
            </div>
                <div class="box-body">
                    <div class="form-group col-md-6 p0 pright5">
                      <label for="name"><?php echo Language::showAdmin('Name', 'Categories'); ?></label>
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['category']['0']->name; ?>" required>
                    </div>
                    <div class="form-group col-md-6 p0 pleft5">
                        <div class="form-group">
                          <label for="id_parent_category"><?php echo Language::showAdmin('Parent Category', 'Categories'); ?></label>
                            <select class="form-control" id="id_parent_category" name="id_parent_category">
                                <?php foreach($data['categories'] as $category): ?>
                                    <option value="<?php echo $category->id_category; ?>" <?php if($category->id_category = $data['category']['0']->id_category_parent): echo 'selected'; endif; ?>><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="short_description"><?php echo Language::showAdmin('Short Description', 'Categories'); ?></label>
                      <textarea id="short_description" name="short_description" class="form-control"><?php echo $data['category']['0']->short_description; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="long_description"><?php echo Language::showAdmin('Long Description', 'Categories'); ?></label>
                      <textarea id="long_description" name="long_description" class="form-control"><?php echo $data['category']['0']->long_description; ?></textarea>
                    </div>
                </div>
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-12 col-md-4">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('SEO', 'Categories'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="meta_title"><?php echo Language::showAdmin('Title', 'Categories'); ?></label>
                          <input type="text" class="form-control" name="meta_title" id="meta_title" value="<?php echo $data['category']['0']->meta_title; ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_description"><?php echo Language::showAdmin('Meta Description', 'Categories'); ?></label>
                          <input type="text" class="form-control" name="meta_description" id="meta_description" value="<?php echo $data['category']['0']->meta_description; ?>">
                        </div>
                        <div class="form-group">
                          <label for="url"><?php echo Language::showAdmin('URL', 'Categories'); ?></label>
                          <input type="text" class="form-control" name="url" id="url" value="<?php echo $data['category']['0']->url; ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_robots"><?php echo Language::showAdmin('Meta Robots', 'Categories'); ?></label>
                            <select class="form-control" id="meta_robots" name="meta_robots">
                                <?php foreach($data['meta_robots'] as $meta_robots): ?>
                                    <option value="<?php echo $meta_robots->id_meta_robots; ?>" <?php if($meta_robots->id_meta_robots = $data['category']['0']->meta_robots): echo 'selected'; endif; ?>><?php echo $meta_robots->content; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                    <button type="submit" name="editCategory" class="btn btn-primary"><?php echo Language::showAdmin('Save', 'Products'); ?></button>
                </div>
            </div><!-- /.box SEO -->
        </div><!-- /.col -->
        <?php echo Form::close(); ?>
      </div>
      <!-- /.row -->
    </section>
</div>