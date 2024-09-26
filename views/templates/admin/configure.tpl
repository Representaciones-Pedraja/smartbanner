{extends file='admin/themes/default/template/controllers/modules/configure.tpl'}

{block name='content'}
<h2>{$module->displayName}</h2>
<form action="{$_SERVER['REQUEST_URI']}"