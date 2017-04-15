<?php
use Core\Error;
use Core\Language;
use Helpers\Form;
use Helpers\Session;
?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?= Language::showAdmin('Add brand', 'Brands'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= Language::showAdmin('Home', 'Brands'); ?></a></li>
        <li><a href="#"><?= Language::showAdmin('Brands', 'Brands'); ?></a></li>
        <li class="active"><?= Language::showAdmin('Add', 'Brands'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?= Error::display($error); ?>
        </div>
        <?= Form::open($params = array('method'=>'post')); ?>
        <div class="col-xs-12 col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= Language::showAdmin('General', 'Brands'); ?></h3>
            </div>
                <div class="box-body">
                    <div class="form-group">
                      <label for="name"><?= Language::showAdmin('Name', 'Brands'); ?></label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="<?= Language::showAdmin('Name', 'Brands'); ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="short_description"><?= Language::showAdmin('Short Description', 'Brands'); ?></label>
                      <textarea id="short_description" name="short_description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="long_description"><?= Language::showAdmin('Long Description', 'Brands'); ?></label>
                      <textarea id="long_description" name="long_description" class="form-control"></textarea>
                    </div>
                </div>
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-12 col-md-4">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?= Language::showAdmin('SEO', 'Brands'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="meta_title"><?= Language::showAdmin('Title', 'Brands'); ?></label>
                          <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="<?= Language::showAdmin('Title', 'Brands'); ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_description"><?= Language::showAdmin('Meta Description', 'Brands'); ?></label>
                          <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="<?= Language::showAdmin('Meta Description', 'Brands'); ?>">
                        </div>
                        <div class="form-group">
                          <label for="meta_robots"><?= Language::showAdmin('Meta Robots', 'Brands'); ?></label>
                            <select class="form-control" id="meta_robots" name="meta_robots">
                                <?php foreach($data['meta_robots'] as $meta_robots): ?>
                                    <option value="<?= $meta_robots->id_meta_robots; ?>"><?= $meta_robots->content; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="url"><?= Language::showAdmin('URL', 'Brands'); ?></label>
                          <input type="text" class="form-control" name="url" id="url" placeholder="<?= Language::showAdmin('URL', 'Brands'); ?>">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="token" value="<?= $data['token']; ?>" />
                    <button type="submit" name="addBrand" class="btn btn-primary"><?= Language::showAdmin('Save', 'Brands'); ?></button>
                </div>
            </div><!-- /.box SEO -->
                   
        </div><!-- /.col -->
        <?= Form::close(); ?>
      </div>
      <!-- /.row -->
    </section>
</div>