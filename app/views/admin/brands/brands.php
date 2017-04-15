<?php
use Core\Language;
use Helpers\Session;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo Language::showAdmin('Brands', 'Brands'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo Language::showAdmin('Home', 'Brands'); ?></a></li>
        <li><a href="#"><?php echo Language::showAdmin('Brands', 'Brands'); ?></a></li>
        <li class="active"><?php echo Language::showAdmin('List', 'Brands'); ?></li>
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
              <h3 class="box-title"><?php echo Language::showAdmin('Brands List', 'Brands'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="brands" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Image', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Name', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Sort', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Brands'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['brands'] as $brand): ?>
                <tr>
                  <td><?php echo $brand->id_brand; ?></td>
                  <td>
                    <?php if (!empty($brand->image)): ?>
                            <img src="<?php echo DIR.URL_IMG_BRAND.$brand->id_brand.'/s-'.$brand->image; ?>" height='100'>
                    <?php else: ?>
                            <p class="alert alert-danger text-center"><?php echo Language::showAdmin('Images', 'Brands'); ?></p>
                    <?php endif; ?>  
                  </td>
                  <td><?php echo $brand->name; ?></td>
                  <td><?php echo $brand->sort; ?></td>
                  <td>
                      <a href="<?php echo DIR.URL_ADMIN.'/brands/edit/'.$brand->id_brand; ?>"><i class="fa fa-pencil"></i> Edit </a>
                      <a href="javascript:delBrand('<?php echo $brand->id_brand; ?>');"><i class="fa fa-trash"></i> Del </a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php echo Language::showAdmin('ID', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Image', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Name', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Sort', 'Brands'); ?></th>
                  <th><?php echo Language::showAdmin('Action', 'Brands'); ?></th>
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