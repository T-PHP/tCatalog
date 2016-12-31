<?php 

use Helpers\Hooks;

Hooks::addHook('columnLeft', 'Modules\Categories\Controllers\Categories@index');