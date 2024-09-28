<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="apple-itunes-app" content="app-id={$smartbanner.app_id}, app-argument={$smartbanner.app_url}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="smartbanner:title" content="{$smartbanner.title}">
    <meta name="smartbanner:author" content="{$smartbanner.author}">
    <meta name="smartbanner:price" content="{$smartbanner.price}">
    <meta name="smartbanner:price-suffix-google" content="{$smartbanner.price_suffix_google}">
    <meta name="smartbanner:icon-google" content="{$smartbanner.icon_google}">
    <meta name="smartbanner:button" content="{$smartbanner.button}">
    <meta name="smartbanner:button-url-google" content="{$smartbanner.button_url_google}">
    <meta name="smartbanner:enabled-platforms" content="{$smartbanner.enabled_platforms}">
    <meta name="smartbanner:custom-design-modifier" content="android">
    <meta name="smartbanner:hide-path" content="/">
    <meta name="smartbanner:close-label" content="{$smartbanner.close_label}">
    
    <link rel="stylesheet" href="{$link->getModuleLink('smartbanner', 'views/css/smartbanner.css', [], true)}">
    <link rel="stylesheet" href="{$link->getModuleLink('smartbanner', 'views/css/smartbanner.min.css', [], true)}">
    <script src="{$link->getModuleLink('smartbanner', 'views/js/smartbanner.js', [], true)}"></script>
</head>
<body>

    {if strpos($smartbanner.enabled_platforms, 'android') !== false}
        <div id="smart-banner" class="smartbanner smartbanner--android">
            <div class="smartbanner-content">
                <img src="{$smartbanner.icon_google}" alt="Google Icon" class="smartbanner__icon" />
                <div class="smartbanner__info">
                    <h2 class="smartbanner__info__title">{$smartbanner.title}</h2>
                    <p class="smartbanner__info__author">{$smartbanner.author}</p>
                    <p class="smartbanner__info__price">{$smartbanner.price}</p>
                </div>
                <a href="{$smartbanner.button_url_google}" class="smartbanner__button">
                    <span class="smartbanner__button__label">ver</span>
                </a>
                <button class="smartbanner__exit" aria-label="{$smartbanner.close_label}"></button> <!-- Este es el único botón de cerrar -->
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
        font-family: Helvetica, sans-serif;
        z-index: 9999; /* Para asegurarnos de que esté encima de otros módulos */
        display: flex; /* Usar flex para el layout */
        align-items: center; /* Centrar verticalmente */
    }

        /* Botón de cerrar */
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

        .smartbanner__exit::before,
        .smartbanner__exit::after {
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

        /* Icono del banner */
        .smartbanner__icon {
		  z-index: 1000;
          position: absolute;
          top: 10px;
          left: 30px;
          width: 64px;
          height: 64px;
          border-radius: 15px;
          background-size: 64px 64px;
        }

        /* Información del banner */
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
		  text-align: left; /* Alineación del texto a la izquierda */
          display: flex;
          flex-direction: column; 
		  z-index: 1000;
        }

        /* Estilos de título y texto */
        .smartbanner__info__title {
          font-size: 14px;
          display: flex;
          flex-direction: column; 
          align-items: left;
        }

        .smartbanner__info__author,
        .smartbanner__info__price {
          font-size: 12px;
		  text-align: left; /* Alineación del texto a la izquierda */
          display: flex;
          align-items: left;
	}

        /* Botón del banner */
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

        /* Estilos específicos para Android */
        .smartbanner.smartbanner--android {
          background: #3d3d3d; /* Fondo del banner para Android */
          box-shadow: inset 0 4px 0 #88b131; /* Sombra interior */
          position: absolute;
          top: 0;
          left: 0;
          overflow-x: hidden;
          width: 100%;
          height: 84px;
          font-family: Helvetica, sans-serif;
          z-index: 9999; /* Para asegurarnos de que esté encima de otros módulos */
          display: flex; /* Usar flex para el layout */
          align-items: center; /* Centrar verticalmente */
		  z-index: 1500;
        }

        .smartbanner.smartbanner--android .smartbanner__exit {
          left: 6px;
          margin-right: 7px;
          width: 17px;
          height: 17px;
          border-radius: 14px;
          background: #1c1e21; /* Fondo del botón de cerrar */
          box-shadow: 0 1px 2px rgba(0, 0, 0, 0.8) inset, 0 1px 1px rgba(255, 255, 255, 0.3);
          color: #b1b1b3; /* Color del icono de cerrar */
          font-family: "ArialRoundedMTBold", Arial;
          font-size: 20px;
          line-height: 17px;
          text-shadow: 0 1px 1px #000; /* Sombra del texto */
		  z-index: 1500;
        }

        .smartbanner.smartbanner--android .smartbanner__exit::before,
        .smartbanner.smartbanner--android .smartbanner__exit::after {
          top: 3px;
          left: 8px;
          width: 2px;
          height: 11px;
          background: #b1b1b3; /* Color de las líneas */
		  z-index: 1500;
        }

        .smartbanner.smartbanner--android .smartbanner__exit:active,
        .smartbanner.smartbanner--android .smartbanner__exit:hover {
          color: #eee; /* Color del icono de cerrar en hover/active */
        }

        .smartbanner.smartbanner--android .smartbanner__icon {
          background-color: transparent; /* Fondo transparente para el icono */
          box-shadow: none; /* Sin sombra para el icono */
        }

        .smartbanner.smartbanner--android .smartbanner__info {
          color: #ccc; /* Color de texto de la información */
          text-shadow: 0 1px 2px #000; /* Sombra del texto */
          text-align: left; /* Alineación del texto a la izquierda */
          align-items: left;
          flex-direction: column
		  z-index: 1500;
        }

        .smartbanner.smartbanner--android .smartbanner__info__title {
          color: #fff; /* Color del título */
          font-weight: bold; /* Negrita */
          text-align: left; /* Alineación del texto a la izquierda */
          align-items: left;
		  z-index: 1500;
        }

        .smartbanner.smartbanner--android .smartbanner__button {
          top: 30px; /* Posición vertical del botón */
          right: 20px; /* Posición horizontal del botón */
          padding: 0; /* Sin padding */
          min-width: 12%; /* Ancho mínimo del botón */
          border-radius: 0; /* Sin esquinas redondeadas */
          background: none; /* Sin fondo */
          box-shadow: 0 0 0 1px #333, 0 0 0 2px #dddcdc; /* Sombra del botón */
          color: #d1d1d1; /* Color del texto del botón */
          font-size: 14px; /* Tamaño de la fuente */
          font-weight: bold; /* Negrita */
		  z-index: 1500;
        }

        .smartbanner.smartbanner--android .smartbanner__button:active,
        .smartbanner.smartbanner--android .smartbanner__button:hover {
          background: none; /* Sin fondo en hover/active */
        }

        .smartbanner.smartbanner--android .smartbanner__button__label {
          display: block; /* Mostrar como bloque */
          padding: 0 10px; /* Padding horizontal */
          background: linear-gradient(to bottom, #42b6c9, #39a9bb); /* Degradado de fondo */
          box-shadow: none; /* Sin sombra */
          line-height: 24px; /* Altura de línea */
          text-align: center; /* Centrar texto */
          text-shadow: none; /* Sin sombra de texto */
          text-transform: none; /* Sin transformación de texto */
        }

        .smartbanner.smartbanner--android .smartbanner__button__label:active,
        .smartbanner.smartbanner--android .smartbanner__button__label:hover {
          background: #2ac7e1; /* Fondo en hover/active */

    </style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeButton = document.querySelector('.smartbanner__exit');
        const smartBanner = document.getElementById('smart-banner');

        if (closeButton) {
            closeButton.addEventListener('click', function () {
                smartBanner.style.display = 'none'; // Oculta el banner
            });
        }
    });
</script>

</body>
</html>
