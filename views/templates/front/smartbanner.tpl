
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="smartbanner:title" content="{$smartbanner.title}">
    <meta name="smartbanner:author" content="{$smartbanner.author}">
    <meta name="smartbanner:price" content="{$smartbanner.price}">
    <meta name="smartbanner:price-suffix-apple" content="{$smartbanner.price_suffix_apple}">
    <meta name="smartbanner:price-suffix-google" content="{$smartbanner.price_suffix_google}">
    <meta name="smartbanner:icon-apple" content="{$smartbanner.icon_apple}">
    <meta name="smartbanner:icon-google" content="{$smartbanner.icon_google}">
    <meta name="smartbanner:button" content="{$smartbanner.button}">
    <meta name="smartbanner:button-url-apple" content="{$smartbanner.button_url_apple}">
    <meta name="smartbanner:button-url-google" content="{$smartbanner.button_url_google}">
    <meta name="smartbanner:enabled-platforms" content="{$smartbanner.enabled_platforms}">
    <meta name="smartbanner:close-label" content="{$smartbanner.close_label}">

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
            
            <div id="platform-buttons">
                <!-- Los botones se llenarán con JavaScript -->
            </div>

            <button id="close-banner" class="close-banner">Cerrar</button>
        </div>
    </div>
{/if}

	<style>
			.smartbanner {
		  position: absolute;
		  top: 0;
		  left: 0;
		  overflow-x: hidden;
		  width: 100%;
		  height: 84px;
		  background: #f3f3f3;
		  font-family: Helvetica, sans, sans-serif;
		  /** Android styles **/
		}
		.smartbanner__exit {
		  position: absolute;
		  top: calc(50% - 6px);
		  left: 9px;
		  display: block;
		  margin: 0;
		  width: 12px;
		  height: 12px;
		  border: 0;
		  text-align: center;
		}
		.smartbanner__exit::before, .smartbanner__exit::after {
		  position: absolute;
		  width: 1px;
		  height: 12px;
		  background: #716F6F;
		  content: " ";
		}
		.smartbanner__exit::before {
		  transform: rotate(45deg);
		}
		.smartbanner__exit::after {
		  transform: rotate(-45deg);
		}
		.smartbanner__icon {
		  position: absolute;
		  top: 10px;
		  left: 30px;
		  width: 64px;
		  height: 64px;
		  border-radius: 15px;
		  background-size: 64px 64px;
		}
		.smartbanner__info {
		  position: absolute;
		  top: 10px;
		  left: 104px;
		  display: flex;
		  overflow-y: hidden;
		  width: 60%;
		  height: 64px;
		  align-items: center;
		  color: #000;
		}
		.smartbanner__info__title {
		  font-size: 14px;
		}
		.smartbanner__info__author, .smartbanner__info__price {
		  font-size: 12px;
		}
		.smartbanner__button {
		  position: absolute;
		  top: 32px;
		  right: 10px;
		  z-index: 1;
		  display: block;
		  padding: 0 10px;
		  min-width: 10%;
		  border-radius: 5px;
		  background: #f3f3f3;
		  color: #1474fc;
		  font-size: 18px;
		  text-align: center;
		  text-decoration: none;
		}
		.smartbanner__button__label {
		  text-align: center;
		}
		.smartbanner.smartbanner--android {
		  background: #3d3d3d url("data:image/gif;base64,R0lGODlhCAAIAIABAFVVVf///yH5BAEHAAEALAAAAAAIAAgAAAINRG4XudroGJBRsYcxKAA7");
		  box-shadow: inset 0 4px 0 #88b131;
		}
		.smartbanner.smartbanner--android .smartbanner__exit {
		  left: 6px;
		  margin-right: 7px;
		  width: 17px;
		  height: 17px;
		  border-radius: 14px;
		  background: #1c1e21;
		  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.8) inset, 0 1px 1px rgba(255, 255, 255, 0.3);
		  color: #b1b1b3;
		  font-family: "ArialRoundedMTBold", Arial;
		  font-size: 20px;
		  line-height: 17px;
		  text-shadow: 0 1px 1px #000;
		}
		.smartbanner.smartbanner--android .smartbanner__exit::before, .smartbanner.smartbanner--android .smartbanner__exit::after {
		  top: 3px;
		  left: 8px;
		  width: 2px;
		  height: 11px;
		  background: #b1b1b3;
		}
		.smartbanner.smartbanner--android .smartbanner__exit:active, .smartbanner.smartbanner--android .smartbanner__exit:hover {
		  color: #eee;
		}
		.smartbanner.smartbanner--android .smartbanner__icon {
		  background-color: transparent;
		  box-shadow: none;
		}
		.smartbanner.smartbanner--android .smartbanner__info {
		  color: #ccc;
		  text-shadow: 0 1px 2px #000;
		}
		.smartbanner.smartbanner--android .smartbanner__info__title {
		  color: #fff;
		  font-weight: bold;
		}
		.smartbanner.smartbanner--android .smartbanner__button {
		  top: 30px;
		  right: 20px;
		  padding: 0;
		  min-width: 12%;
		  border-radius: 0;
		  background: none;
		  box-shadow: 0 0 0 1px #333, 0 0 0 2px #dddcdc;
		  color: #d1d1d1;
		  font-size: 14px;
		  font-weight: bold;
		}
		.smartbanner.smartbanner--android .smartbanner__button:active, .smartbanner.smartbanner--android .smartbanner__button:hover {
		  background: none;
		}
		.smartbanner.smartbanner--android .smartbanner__button__label {
		  display: block;
		  padding: 0 10px;
		  background: #42b6c9;
		  background: linear-gradient(to bottom, #42b6c9, #39a9bb);
		  box-shadow: none;
		  line-height: 24px;
		  text-align: center;
		  text-shadow: none;
		  text-transform: none;
		}
		.smartbanner.smartbanner--android .smartbanner__button__label:active, .smartbanner.smartbanner--android .smartbanner__button__label:hover {
		  background: #2ac7e1;
		}
    }
	</style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var platformButtons = document.getElementById('platform-buttons');
            var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            var isAndroid = /Android/.test(navigator.userAgent);

            // Mostrar el botón adecuado según la plataforma
            if (isIOS && '{$smartbanner.button_url_apple}' !== '') {
                platformButtons.innerHTML += '<a href="{$smartbanner.button_url_apple}" class="btn-apple">Descargar en Apple</a>';
            }

            if (isAndroid && '{$smartbanner.button_url_google}' !== '') {
                platformButtons.innerHTML += '<a href="{$smartbanner.button_url_google}" class="btn-google">Descargar en Google</a>';
            }

            // Cerrar el banner
            document.getElementById('close-banner').addEventListener('click', function() {
                document.getElementById('smart-banner').style.display = 'none';
            });
        });
    </script>
{/if}


