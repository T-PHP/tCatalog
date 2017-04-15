<?php
use Core\Language;
use Helpers\Session;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= Language::showAdmin('Languages', 'Settings'); ?>
      </h1>
      <ol class="breadcrumb">
        <a href="<?= DIR.URL_ADMIN.'/settings/languages/add'; ?>" class="btn btn-success">ADD</a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?= Session::message('message'); ?>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= Language::showAdmin('Languages', 'Settings'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="products" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th><?= Language::showAdmin('ID', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Name', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Iso', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Default', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Action', 'Products'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['languages'] as $language): ?>
                <tr>
                  <td><?= $language->id_language; ?></td>
                  <td><?= $language->name; ?></td>
                  <td><?= $language->iso; ?></td>
                  <td><?= $language->default_lang; ?></td>    
                  <td>
                      <a href="<?= DIR.URL_ADMIN.'/settings/languages/edit/'.$language->id_language; ?>"><i class="fa fa-pencil"></i> Edit </a>
                      <a href="javascript:delLanguage('<?= $language->id_language; ?>');"><i class="fa fa-trash"></i> Del </a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?= Language::showAdmin('ID', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Name', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Iso', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Default', 'Settings'); ?></th>
                  <th><?= Language::showAdmin('Action', 'Products'); ?></th>
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