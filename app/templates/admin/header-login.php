<?php
use Helpers\Assets;
use Helpers\Url;
use Core\Language;
?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<title><?php echo $data['title'].' - '.SITETITLE; ?></title>
	<!-- CSS -->
	<?php
    Assets::css([
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        Url::templateAdminPath().'css/font-awesome-4.7.0/css/font-awesome.min.css',
        Url::templateAdminPath().'css/admin-lte-2.3.7/AdminLTE.min.css',
        Url::templateAdminPath().'css/admin-lte-2.3.7/skin-blue.css',
        Url::templateAdminPath().'css/style.css',
        Url::templateAdminPath().'css/paddingmargin.css',
    ]);
    ?>
    <?php echo $data['css']; ?>
</head>
<body class="hold-transition login-page">

