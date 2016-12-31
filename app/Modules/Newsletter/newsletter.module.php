<?php 

use Helpers\Hooks;

Hooks::addHook('headerRight', 'Modules\Newsletter\Controllers\Newsletter@index');
//Hooks::addHook('routes', 'Modules\Newsletter\Controllers\Newsletter@routes');