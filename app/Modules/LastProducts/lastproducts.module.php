<?php 

use Helpers\Hooks;

Hooks::addHook('homeCenter', 'Modules\LastProducts\Controllers\LastProducts@index');
Hooks::addHook('js', 'Modules\LastProducts\Controllers\LastProducts@js');