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
        <?php echo Language::showAdmin('Meta Robots', 'Seo'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Seo'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('SEO', 'Seo'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('Meta Robots', 'Seo'); ?></li>
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
              <h3 class="box-title"><?php echo Language::showAdmin('Meta Robots List', 'Seo'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Seo'); ?></th>
                  <th><?php echo Language::showAdmin('Content', 'Seo'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Seo'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['meta_robots'] as $meta_robots): ?>
                <tr>
                  <td><?php echo $meta_robots->id_meta_robots; ?></td>
                  <td><?php echo $meta_robots->content; ?></td>
                  <td>
                      <a href="javascript:delMetaRobots('<?php echo $meta_robots->id_meta_robots; ?>');"><i class="fa fa-trash"></i> Del </a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Seo'); ?></th>
                  <th><?php echo Language::showAdmin('Content', 'Seo'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Seo'); ?></th>
                </tr>
                </tfoot>
              </table>
            </div> <!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('Add Meta Robots', 'Seo'); ?></h3>
            </div>
            <!-- /.box-header -->
            <?php echo Form::open($params = array('method'=>'post')); ?>
            <div class="box-body">
                <div class="form-group">
                  <label for="content"><?php echo Language::showAdmin('Content', 'Seo'); ?></label>
                  <input type="text" class="form-control" name="content" id="content" placeholder="<?php echo Language::showAdmin('Content', 'Seo'); ?>">
                </div>
            </div> <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="token" value="<?php echo $data['token']; ?>" />
                <button type="submit" name="addMetaRobots" class="btn btn-primary"><?php echo Language::showAdmin('Save', 'Seo'); ?></button>
            </div>
            <?php echo Form::close(); ?>
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
      
    </section>
</div>