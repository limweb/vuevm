<?php
if (APPMODE == 'debug') {
    $server->addClass('TestController', '/system/test', 'sys');
}

$server->addThemeClass('AdminThemeController', 'sys');
// $server->addClass('AdminlteController', '/admin', 'sys'); // fortest
// $server->addClass('AdminController', 'sys'); // Adminthem root file
$server->addClass('AdminController', '/admin', 'sys'); // fortest

$server->addThemeClass('SystemThemeController', 'sys');
$server->addClass('SystemController', '/system', 'sys'); // fortest


$server->addClass('LineServiceController', '/system/line', 'sys');
$server->addClass('SysController', 'sys'); // 
$server->addClass('GentableController', '/system/generator', 'sys'); // fortest
$server->addClass('QuestionController', '/api/v1/q', 'sys'); // fortest
$server->addClass('AnswerController', '/api/v1/answer', 'sys'); // fortest
// $server->addClass('UserController', '/api/users', 'sys'); // fortest
$server->addClass('RoleController', '/role', 'sys'); // fortest
$server->addClass('PermissController', '/permiss', 'sys'); // fortest
$server->addClass('RController', '/rbac', 'sys'); // fortest
$server->addClass('TController', '/t', 'sys'); // fortest
$server->addClass('AppController', '/api/v1', 'sys'); // fortest
$server->addClass('TlenController', '/tlen', 'sys'); // fortest
$server->addClass('JwtController', '', 'sys'); // fortest
$server->addClass('ColumnController','/api/v3/columns','sys'); 
$server->addClass('DbinfoController','/api/v3/dbinfos','sys'); 
$server->addClass('MenuController','/api/v3/menus','sys'); 
$server->addClass('AppController', '/api/v3/apps', 'sys');
$server->addClass('ColumnController', '/api/v3/columns', 'sys');
$server->addClass('CompanyController', '/api/v3/companies', 'sys');
$server->addClass('DbinfoController', '/api/v3/dbinfos', 'sys');
$server->addClass('MenuController', '/api/v3/menus', 'sys');
$server->addClass('Model_has_permissionController', '/api/v3/model_has_permissions', 'sys');
$server->addClass('Model_has_roleController', '/api/v3/model_has_roles', 'sys');
$server->addClass('ModuleController', '/api/v3/modules', 'sys');
$server->addClass('PackageController', '/api/v3/packages', 'sys');
$server->addClass('Password_resetController', '/api/v3/password_resets', 'sys');
$server->addClass('PermissionController', '/api/v3/permissions', 'sys');
$server->addClass('ProfileController', '/api/v3/profiles', 'sys');
$server->addClass('Role_has_permissionController', '/api/v3/role_has_permissions', 'sys');
$server->addClass('RoleController', '/api/v3/roles', 'sys');
$server->addClass('SyspackageController', '/api/v3/syspackages', 'sys');
$server->addClass('UserController', '/api/v3/users', 'sys');

// $server->addClass('RootController', '', 'sys'); // roottheme rootfile
$server->addThemeClass('RootThemeController', 'sys'); 
$server->addClass('LcrmController', '', 'sys'); // roottheme rootfile
if (file_exists(__DIR__ . '/routebygen.php')) {
    require_once __DIR__ . '/routebygen.php';
}
