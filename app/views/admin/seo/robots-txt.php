<?php
use Core\Error;
use Core\Language;
use Helpers\Form;
use Helpers\Session;
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo Language::showAdmin('Robots.txt', 'Seo'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Seo'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('SEO', 'Seo'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('Robots.txt', 'Seo'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php echo Session::message('message');?>
            <?php echo Error::display($error); ?>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('Edit "robots.txt" file', 'Seo'); ?></h3>
            </div>
            <!-- /.box-header -->
            <?php echo Form::open($params = array('method'=>'post')); ?>
            <div class="box-body">
                <div class="form-group">
                    <label for="content"><?php echo Language::showAdmin('Content', 'Seo'); ?></label>
                    <textarea class="form-control" name="content" rows="15"><?php echo $data['content']; ?></textarea>
                </div>
            </div> <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                <button type="submit" name="editRobotsTxt" class="btn btn-primary"><?php echo Language::showAdmin('Save', 'Seo'); ?></button>
            </div>
            <?php echo Form::close(); ?>
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
      
    </section>
</div>