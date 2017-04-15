<?php
use Core\Language;
use Helpers\Form;
use Helpers\Session;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= Language::showAdmin('Add language', 'Settings'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= Language::showAdmin('Home', 'Settings'); ?></a></li>
        <li><a href="#"><?= Language::showAdmin('Settings', 'Settings'); ?></a></li>
        <li><a href="#"><?= Language::showAdmin('Languages', 'Settings'); ?></a></li>
        <li class="active"><?= Language::showAdmin('Add', 'Settings'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?= Session::message('message'); ?>
        </div>
          
        <?= Form::open($params = array('method'=>'post')); ?>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= Language::showAdmin('Add a new language', 'Settings'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
                <div class="form-group">
                    <label for="name"><?= Language::showAdmin('Name', 'Settings'); ?></label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="<?= Language::showAdmin('Name', 'Settings'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="iso"><?= Language::showAdmin('ISO', 'Settings'); ?></label>
                    <input type="text" class="form-control" name="iso" id="iso" placeholder="<?= Language::showAdmin('ISO', 'Settings'); ?>" required>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="token" value="<?= $data['token']; ?>" />
                <button type="submit" name="addLanguage" class="btn btn-primary"><?= Language::showAdmin('Save', 'Settings'); ?></button>
            </div>
          </div><!-- /.box -->
        </div><!-- /.col -->
        <?= Form::close(); ?>
      </div><!-- /.row -->
    </section>
</div>