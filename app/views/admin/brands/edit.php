<?php
use Core\Error;
use Core\Language;
use Helpers\Form;
use Helpers\Session;
?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo Language::showAdmin('Edit brand', 'Brands'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Brands'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('Brands', 'Brands'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('Edit', 'Brands'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php echo Session::message('message');?>
            <?php echo Error::display($error); ?>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="col-xs-12 col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('General', 'Brands'); ?></h3>
              <div class="pull-right">
                <div class="form-group">
                    <label class="radio-inline">
                      <input type="radio" name="status" value="0" <?php if($data['brand']['0']->status == 0): ?> checked <?php endif; ?>> Disable
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" value="1" <?php if($data['brand']['0']->status == 1): ?> checked <?php endif; ?>> Enable
                    </label>
                </div>
              </div>
            </div>
                <div class="box-body">
                    <div class="form-group">
                      <label for="name"><?php echo Language::showAdmin('Name', 'Brands'); ?></label>
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['brand']['0']->name; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="short_description"><?php echo Language::showAdmin('Short Description', 'Brands'); ?></label>
                      <textarea id="short_description" name="short_description" class="form-control"><?php echo $data['brand']['0']->short_description; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="long_description"><?php echo Language::showAdmin('Long Description', 'Brands'); ?></label>
                      <textarea id="long_description" name="long_description" class="form-control"><?php echo $data['brand']['0']->long_description; ?></textarea>
                    </div>
                </div>
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-12 col-md-4">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('SEO', 'Brands'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="meta_title"><?php echo Language::showAdmin('Title', 'Brands'); ?></label>
                          <input type="text" class="form-control" name="meta_title" id="meta_title" value="<?php echo $data['brand']['0']->meta_title; ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_description"><?php echo Language::showAdmin('Meta Description', 'Brands'); ?></label>
                          <input type="text" class="form-control" name="meta_description" id="meta_description" value="<?php echo $data['brand']['0']->meta_description; ?>">
                        </div>
                        <div class="form-group">
                          <label for="url"><?php echo Language::showAdmin('URL', 'Brands'); ?></label>
                          <input type="text" class="form-control" name="url" id="url" value="<?php echo $data['brand']['0']->url; ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_robots"><?php echo Language::showAdmin('Meta Robots', 'Brands'); ?></label>
                            <select class="form-control" id="meta_robots" name="meta_robots">
                                <?php foreach($data['meta_robots'] as $meta_robots): ?>
                                    <option value="<?php echo $meta_robots->id_meta_robots; ?>" <?php if($meta_robots->id_meta_robots = $data['brand']['0']->meta_robots): echo 'selected'; endif; ?>><?php echo $meta_robots->content; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- /.box SEO -->
            
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo Language::showAdmin('Images', 'Brands'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="image"><?php echo Language::showAdmin('Images', 'Brands'); ?></label>
                            <input type="file" class="form-control" id="image" name="image" value="">
                            <?php if (!empty($data['brand'][0]->image)): ?>
                                    <img src="<?php echo DIR.IMG_BRAND.$data['brand']['0']->id_brand.'/m-'.$data['brand']['0']->image; ?>" class='img-responsive'>
                            <?php else: ?>
                                    <p class="alert alert-danger text-center"><?php echo Language::showAdmin('Images', 'Brands'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                    <button type="submit" name="editBrand" class="btn btn-primary"><?php echo Language::showAdmin('Save', 'Brands'); ?></button>
                </div>
            </div><!-- /.box Images -->
        </div><!-- /.col -->
          </form>
      </div>
      <!-- /.row -->
    </section>
</div>