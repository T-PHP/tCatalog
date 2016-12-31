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
<div class="container-fluid tcatalog-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="">TITRE</div>
                <div class="">CONTENU</div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="">TITRE</div>
                <div class="">CONTENU</div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="">TITRE</div>
                <div class="">CONTENU</div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="">TITRE</div>
                <div class="">CONTENU</div>
            </div>
        </div>
        <div class="row copyright">
            <div class="col-xs-12">
                <p>Copyright 2016 ....</p>
            </div>
        </div>
    </div>
</div>   
<!-- JS -->
<?php
Assets::js([
    Url::templatePath().'js/jquery.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
]);
echo $data['js'];
//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
