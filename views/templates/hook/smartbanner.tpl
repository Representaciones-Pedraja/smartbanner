<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="smartbanner:title" content="{$title|escape:'html':'UTF-8'}">
<meta name="smartbanner:author" content="{$author|escape:'html':'UTF-8'}">
<meta name="smartbanner:price" content="{$price|escape:'html':'UTF-8'}">
<meta name="smartbanner:price-suffix-apple" content="{$price_suffix_apple|escape:'html':'UTF-8'}">
<meta name="smartbanner:price-suffix-google" content="{$price_suffix_google|escape:'html':'UTF-8'}">
<meta name="smartbanner:icon-apple" content="{$icon_apple|escape:'html':'UTF-8'}">
<meta name="smartbanner:icon-google" content="{$icon_google|escape:'html':'UTF-8'}">
<meta name="smartbanner:button" content="{$button|escape:'html':'UTF-8'}">

{if !empty($button_apple)}
    <meta name="smartbanner:button-apple" content="{$button_apple|escape:'html':'UTF-8'}">
{/if}
{if !empty($button_google)}
    <meta name="smartbanner:button-google" content="{$button_google|escape:'html':'UTF-8'}">
{/if}

<meta name="smartbanner:button-url-apple" content="{$url_apple|escape:'html':'UTF-8'}">
<meta name="smartbanner:button-url-google" content="{$url_google|escape:'html':'UTF-8'}">
<meta name="smartbanner:enabled-platforms" content="{$platforms|escape:'html':'UTF-8'}">
<meta name="smartbanner:close-label" content="{$close_label|escape:'html':'UTF-8'}">

{if !empty($hide_ttl)}
    <meta name="smartbanner:hide-ttl" content="{$hide_ttl|escape:'html':'UTF-8'}">
{/if}
{if !empty($hide_path)}
    <meta name="smartbanner:hide-path" content="{$hide_path|escape:'html':'UTF-8'}">
{/if}
{if !empty($disable_positioning)}
    <meta name="smartbanner:disable-positioning" content="true">
{/if}
{if !empty($user_agent_regex)}
    <meta name="smartbanner:include-user-agent-regex" content="{$user_agent_regex|escape:'html':'UTF-8'}">
{/if}

<link rel="stylesheet" href="{$module_dir}views/assets/css/smartbanner.css">
<script src="{$module_dir}views/assets/js/smartbanner.js"></script>

<h1>&nbsp;</h1>

<script>
    document.addEventListener('smartbanner.view', function() { console.log('smartbanner.view'); });
    document.addEventListener('smartbanner.exit', function() { console.log('smartbanner.exit'); });
    document.addEventListener('smartbanner.clickout', function() { console.log('smartbanner.clickout'); });
</script>