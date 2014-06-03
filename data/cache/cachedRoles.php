<?php
$cachedRoleGroups['group_admin'] = [
	'name' => 'group_admin',
	'type' => 1,
	'description' => '管理员组',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401369900',
	'updated_at' => '1401369900',
	'roles' => [
		'admin_level_0',
		'admin_level_1',
		'admin_level_2',
	],
];
$cachedRoleGroups['group_custom'] = [
	'name' => 'group_custom',
	'type' => 1,
	'description' => '自定义组',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401451311',
	'updated_at' => '1401451311',
	'roles' => [
		'custom_level_0',
		'custom_level_1',
	],
];
$cachedRoleGroups['group_member'] = [
	'name' => 'group_member',
	'type' => 1,
	'description' => '会员组',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401369927',
	'updated_at' => '1401369927',
	'roles' => [
		'member_level_0',
		'member_level_1',
		'member_level_2',
		'member_level_3',
		'member_level_4',
		'member_level_5',
		'member_level_6',
	],
];
$cachedRoleGroups['group_special'] = [
	'name' => 'group_special',
	'type' => 1,
	'description' => '特殊组',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401369950',
	'updated_at' => '1401369950',
	'roles' => [
		'special_level_0',
		'special_levle_1',
	],
];
$cachedRoles['admin_level_0'] = [
	'group' => 'group_admin',
	'name' => 'admin_level_0',
	'type' => 1,
	'description' => '管理员',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720843',
	'updated_at' => '1401720843',
	'permissions' => [
		'post_add',
		'post_delete',
		'post_edit',
		'thread_add',
		'thread_delete',
		'thread_edit',
		'thread_view',
	],
];
$cachedRoles['admin_level_1'] = [
	'group' => 'group_admin',
	'name' => 'admin_level_1',
	'type' => 1,
	'description' => '超级版主',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720881',
	'updated_at' => '1401720881',
	'permissions' => [
	],
];
$cachedRoles['admin_level_2'] = [
	'group' => 'group_admin',
	'name' => 'admin_level_2',
	'type' => 1,
	'description' => '版主',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720900',
	'updated_at' => '1401720900',
	'permissions' => [
	],
];
$cachedRoles['custom_level_0'] = [
	'group' => 'group_custom',
	'name' => 'custom_level_0',
	'type' => 1,
	'description' => '自定义角色0',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720765',
	'updated_at' => '1401720765',
	'permissions' => [
	],
];
$cachedRoles['custom_level_1'] = [
	'group' => 'group_custom',
	'name' => 'custom_level_1',
	'type' => 1,
	'description' => '自定义角色1',
	'rule_name' => '',
	'data' => 's:0:"";',
	'created_at' => '1401720781',
	'updated_at' => '1401721363',
	'permissions' => [
	],
];
$cachedRoles['member_level_0'] = [
	'group' => 'group_member',
	'name' => 'member_level_0',
	'type' => 1,
	'description' => '限制会员',
	'rule_name' => '',
	'data' => 's:0:"";',
	'created_at' => '1401720496',
	'updated_at' => '1401722061',
	'permissions' => [
		'post_delete',
		'post_edit',
		'thread_delete',
	],
];
$cachedRoles['member_level_1'] = [
	'group' => 'group_member',
	'name' => 'member_level_1',
	'type' => 1,
	'description' => '新手上路',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720515',
	'updated_at' => '1401720515',
	'permissions' => [
		'post_delete',
		'post_edit',
		'thread_add',
		'thread_delete',
		'thread_edit',
		'thread_view',
	],
];
$cachedRoles['member_level_2'] = [
	'group' => 'group_member',
	'name' => 'member_level_2',
	'type' => 1,
	'description' => '注册会员',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720529',
	'updated_at' => '1401720529',
	'permissions' => [
		'post_add',
		'post_delete',
		'post_edit',
		'thread_add',
		'thread_delete',
		'thread_edit',
		'thread_view',
	],
];
$cachedRoles['member_level_3'] = [
	'group' => 'group_member',
	'name' => 'member_level_3',
	'type' => 1,
	'description' => '中级会员',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720551',
	'updated_at' => '1401720551',
	'permissions' => [
		'post_add',
		'post_delete',
		'post_edit',
		'thread_add',
		'thread_delete',
		'thread_edit',
		'thread_view',
	],
];
$cachedRoles['member_level_4'] = [
	'group' => 'group_member',
	'name' => 'member_level_4',
	'type' => 1,
	'description' => '高级会员',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720567',
	'updated_at' => '1401720567',
	'permissions' => [
		'post_add',
		'post_delete',
		'post_edit',
		'thread_add',
		'thread_delete',
		'thread_edit',
		'thread_view',
	],
];
$cachedRoles['member_level_5'] = [
	'group' => 'group_member',
	'name' => 'member_level_5',
	'type' => 1,
	'description' => '金牌会员',
	'rule_name' => '',
	'data' => 's:0:"";',
	'created_at' => '1401720580',
	'updated_at' => '1401801898',
	'permissions' => [
		'post_add',
		'post_delete',
		'post_edit',
		'thread_add',
		'thread_delete',
		'thread_edit',
		'thread_view',
	],
];
$cachedRoles['member_level_6'] = [
	'group' => 'group_member',
	'name' => 'member_level_6',
	'type' => 1,
	'description' => '论坛元老',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720596',
	'updated_at' => '1401720596',
	'permissions' => [
		'post_add',
		'post_delete',
		'post_edit',
		'thread_add',
		'thread_delete',
		'thread_edit',
		'thread_view',
	],
];
$cachedRoles['special_level_0'] = [
	'group' => 'group_special',
	'name' => 'special_level_0',
	'type' => 1,
	'description' => '特殊角色0',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720708',
	'updated_at' => '1401720708',
	'permissions' => [
	],
];
$cachedRoles['special_levle_1'] = [
	'group' => 'group_special',
	'name' => 'special_levle_1',
	'type' => 1,
	'description' => '特殊角色1',
	'rule_name' => '',
	'data' => '',
	'created_at' => '1401720727',
	'updated_at' => '1401720727',
	'permissions' => [
	],
];
