{if isset($smartbanner)}
    <div id="smart-banner" class="smart-banner">
        <div class="smart-banner-content">
            {if $smartbanner.icon_apple}
                <img src="{$smartbanner.icon_apple}" alt="Apple Icon" class="smart-banner-icon" />
            {/if}
            {if $smartbanner.icon_google}
                <img src="{$smartbanner.icon_google}" alt="Google Icon" class="smart-banner-icon" />
            {/if}
            <h2 class="smart-banner-title">{$smartbanner.title}</h2>
            <p class="smart-banner-author">{$smartbanner.author}</p>
            <p class="smart-banner-price">{$smartbanner.price}</p>
            {if strpos($smartbanner.enabled_platforms, 'ios') !== false}
                <a href="{$smartbanner.button_url_apple}" class="btn-apple">Descargar en Apple</a>
            {/if}
            {if strpos($smartbanner.enabled_platforms, 'android') !== false}
                <a href="{$smartbanner.button_url_google}" class="btn-google">Descargar en Google</a>
            {/if}
            <button id="close-banner" class="close-banner">Cerrar</button>
        </div>
    </div>
{/if}

<style>
    .smart-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #fff;
        border-top: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .smart-banner-content {
        text-align: center;
    }

    .smart-banner-icon {
        width: 50px; /* Ajusta según sea necesario */
        height: auto;
        margin-bottom: 10px;
    }

    .smart-banner-title {
        font-size: 1.5em;
        margin: 10px 0;
    }

    .smart-banner-author,
    .smart-banner-price {
        font-size: 1em;
        margin: 5px 0;
    }

    .btn-apple,
    .btn-google {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        background-color: #007bff; /* Ajusta el color según sea necesario */
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-apple:hover,
    .btn-google:hover {
        background-color: #0056b3; /* Color de hover */
    }

    .close-banner {
        background: none;
        border: none;
        color: #ff0000; /* Color del texto para cerrar */
        font-size: 1em;
        cursor: pointer;
        margin-top: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeButton = document.getElementById('close-banner');
        const smartBanner = document.getElementById('smart-banner');

        if (closeButton) {
            closeButton.addEventListener('click', function () {
                smartBanner.style.display = 'none'; // Oculta el banner
            });
        }
    });
</script>

