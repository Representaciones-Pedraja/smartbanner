{if isset($smartbanner) && $smartbanner.enabled_platforms|@explode:','|@count > 0}
    <div id="smartbanner">
        <div class="smartbanner-content">
            <img src="{$smartbanner.icon_apple}" alt="{$smartbanner.title} Icon" class="smartbanner-icon" />
            <div class="smartbanner-details">
                <h2>{$smartbanner.title}</h2>
                <p>{$smartbanner.author} - {$smartbanner.price}</p>
                <div class="smartbanner-buttons">
                    {if strpos($smartbanner.enabled_platforms, 'ios') !== false}
                        <a href="{$smartbanner.button_url_apple}" class="smartbanner-button" target="_blank">
                            {$smartbanner.button_label} {if isset($smartbanner.price_suffix_apple)}{$smartbanner.price_suffix_apple}{/if}
                        </a>
                    {/if}
                    {if strpos($smartbanner.enabled_platforms, 'android') !== false}
                        <a href="{$smartbanner.button_url_google}" class="smartbanner-button" target="_blank">
                            {$smartbanner.button_label} {if isset($smartbanner.price_suffix_google)}{$smartbanner.price_suffix_google}{/if}
                        </a>
                    {/if}
                </div>
            </div>
            <button class="smartbanner-close" aria-label="{$smartbanner.close_label}">✕</button>
        </div>
    </div>
{/if}