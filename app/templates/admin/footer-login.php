<?php
use Helpers\Assets;
use Helpers\Url;
?>

<!-- JS -->
<?php
Assets::js([
    Url::templateAdminPath().'js/jquery-2.2.3.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
    Url::templateAdminPath().'js/admin-lte-2.3.7/app.min.js',
    Url::templateAdminPath().'js/admin-lte-2.3.7/demo.js',
]);
echo $data['js'];
?>

</body>
</html>