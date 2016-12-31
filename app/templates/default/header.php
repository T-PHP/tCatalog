<?php
/**
 * Sample layout.
 */
use Helpers\Assets;
use Helpers\Hooks;
use Helpers\Url;

//initialise hooks
$hooks = Hooks::get();
?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<?php
    //hook for plugging in meta tags
    $hooks->run('meta');
    ?>
	<title><?php echo $data['title'].' - '.SITETITLE; ?></title>
    <?php if(!empty($data['meta_description'])): ?>
        <meta name="description" content="<?php echo $data['meta_description']; ?>">
    <?php endif; ?>
	<!-- CSS -->
	<?php
    Assets::css([
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        Url::templatePath().'css/font-awesome-4.7.0/css/font-awesome.min.css',
        Url::templatePath().'css/style.css',
        Url::templatePath().'css/product.css',
        Url::templatePath().'css/category.css',
        Url::templatePath().'css/paddingmargin.css',
    ]);

    //hook for plugging in css
    $hooks->run('css');
    ?>

</head>
<body>
<?php
//hook for running code after body tag
$hooks->run('afterBody');
?>
<div class="container-fluid tcatalog-header">
    <div class="container">
        <div class="row-fluid">
            <div class="col-md-4">
                <a href="<?php echo DIR.URL_HOME; ?>">
                    <img src="http://www.resultat-euromillion.net/img/logo-euromillions-mymillion.png" class="img-responsive" />
                </a>
            </div>
            <div class="col-md-8">
                <?php $hooks->run('headerRight'); ?>
            </div>
        </div>
    </div> 
</div>
    <?php $hooks->run('topMenu'); ?>
    <div class="container-fluid tcatalog-menu">
        <div class="container">
            <nav class="navbar navbar-default tcatalog-nav-menu">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-left">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        </div>
    </div>
<div class="container">
    <div class="row">
                
    </div><!-- End Row -->
</div><!-- End Container -->