<?php
use Core\Language;
use Helpers\Session;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo Language::showAdmin('Products', 'Products'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Products'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('Products', 'Products'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('List', 'Products'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php echo Session::message('message'); ?>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo Language::showAdmin('Products List', 'Products'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="products" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Image', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Name', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Price', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Products'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['products'] as $product): ?>
                <tr>
                  <td><?php echo $product->id_product; ?></td>
                  <td>-</td>
                  <td><?php echo $product->name; ?></td>
                  <td><?php echo $product->price; ?></td>
                  <td>
                      <a href="<?php echo DIR.URL_ADMIN.'/products/edit/'.$product->id_product; ?>"><i class="fa fa-pencil"></i> Edit </a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Image', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Name', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Price', 'Products'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Products'); ?></th>
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