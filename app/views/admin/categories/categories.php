<?php
use Core\Language;
use Helpers\Session;
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo Language::showAdmin('Categories', 'Categories'); ?>
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Categories'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('Categories', 'Categories'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('List', 'Categories'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php echo Session::message('message');?>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('Categories List', 'Categories'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="categories" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Categories'); ?></th>
                  <th><?php echo Language::showAdmin('Image', 'Categories'); ?></th>
                  <th><?php echo Language::showAdmin('Name', 'Categories'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Categories'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['categories'] as $category): ?>
                <tr>
                  <td><?php echo $category->id_category; ?></td>
                  <td>-</td>
                  <td><?php echo $category->name; ?></td>
                  <td>
                      <a href="<?php echo DIR.URL_ADMIN.'/categories/edit/'.$category->id_category; ?>"><i class="fa fa-pencil"></i> Edit </a>
                      <a href="javascript:delCategory('<?php echo $category->id_category; ?>');"><i class="fa fa-trash"></i> Del </a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Categories'); ?></th>
                  <th><?php echo Language::showAdmin('Image', 'Categories'); ?></th>
                  <th><?php echo Language::showAdmin('Name', 'Categories'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Categories'); ?></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>