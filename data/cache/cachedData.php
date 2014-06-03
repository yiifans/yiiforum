<?php
$cachedBoards=[];

$cachedRoleGroups=[];
$cachedRoles=[];
$cachedPermissionCategories=[];
$cachedPermissions=[];

require(__DIR__ . '/cachedBoards.php');
require(__DIR__ . '/cachedRoles.php');
require(__DIR__ . '/cachedPermissions.php');


return [
	'cachedBoards'=>$cachedBoards,
	'cachedRoleGroups'=>$cachedRoleGroups,
	'cachedRoles'=>$cachedRoles,
	'cachedPermissionCategories'=>$cachedPermissionCategories,
	'cachedPermissions'=>$cachedPermissions,
];
