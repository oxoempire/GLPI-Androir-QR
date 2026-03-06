<?php
class PluginInventoryqrConfig extends CommonGLPI
{

    public static function getTypeName($nb = 0)
    {
        return 'Android QR Config';
    }

    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {
        if ($item->getType() == 'Config') {
            return __('Android Inventory QR', 'inventoryqr');
        }
        return '';
    }

    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {
        if ($item->getType() == 'Config') {
            self::showConfigForm();
        }
        return true;
    }

    public static function showConfigForm()
    {
        global $CFG_GLPI;

        $url_base = $CFG_GLPI['url_base'];
        $default_url = $url_base . '/marketplace/glpiinventory';

        $plugin_url = $CFG_GLPI['root_doc'] . '/plugins/inventoryqr';

        echo "<div class='center' id='inventoryqr-container' style='width: 80%; margin: auto;'>";
        echo "<table class='tab_cadre_fixe'>";
        echo "<tr class='tab_bg_1'><th colspan='2' class='center'><b>Generación de QR para Android Inventory</b></th></tr>";

        // URL
        echo "<tr class='tab_bg_1'>";
        echo "<td>URL (En blanco usa predeterminado)</td>";
        echo "<td><input type='text' id='qr_url' placeholder='$default_url' class='form-control'></td>";
        echo "</tr>";

        // TAG
        echo "<tr class='tab_bg_1'>";
        echo "<td>TAG</td>";
        echo "<td><input type='text' id='qr_tag' placeholder='ej: android_samsung' class='form-control'></td>";
        echo "</tr>";

        // LOGIN
        echo "<tr class='tab_bg_1'>";
        echo "<td>LOGIN</td>";
        echo "<td><input type='text' id='qr_login' class='form-control' placeholder='usuario'></td>";
        echo "</tr>";

        // PASSWORD
        echo "<tr class='tab_bg_1'>";
        echo "<td>PASSWORD</td>";
        echo "<td><input type='password' id='qr_password' class='form-control' placeholder='contraseña'></td>";
        echo "</tr>";

        // ASSET_ITEMTYPE
        echo "<tr class='tab_bg_1'>";
        echo "<td>ASSET_ITEMTYPE (Obligatorio)</td>";
        echo "<td>";
        echo "<select id='qr_asset_itemtype' class='form-select'>";
        echo "<option value='Phone'>Phone</option>";
        echo "<option value='Computer'>Computer</option>";
        echo "</select>";
        echo "</td>";
        echo "</tr>";

        // ANDROID_AUTOMATIC_INVENTORY
        echo "<tr class='tab_bg_1'>";
        echo "<td>ANDROID_AUTOMATIC_INVENTORY</td>";
        echo "<td>";
        echo "<select id='qr_auto_inv' class='form-select'>";
        echo "<option value='1'>Sí (1)</option>";
        echo "<option value='0'>No (0)</option>";
        echo "</select>";
        echo "</td>";
        echo "</tr>";

        // ANDROID_FREQUENCY
        echo "<tr class='tab_bg_1'>";
        echo "<td>ANDROID_FREQUENCY</td>";
        echo "<td>";
        echo "<select id='qr_frequency' class='form-select'>";
        echo "<option value='Week'>Week</option>";
        echo "<option value='Day'>Day</option>";
        echo "</select>";
        echo "</td>";
        echo "</tr>";

        // Buttons
        echo "<tr class='tab_bg_2'>";
        echo "<td colspan='2' class='center'>";
        echo "<button type='button' class='btn btn-primary me-2' onclick='generateQR()' style='margin-right: 10px;'><i class='fas fa-qrcode'></i> Generar QR</button>";
        echo "<button type='button' class='btn btn-secondary' onclick='clearQR()'><i class='fas fa-eraser'></i> Limpiar datos</button>";
        echo "</td>";
        echo "</tr>";

        // Result container
        echo "<tr>";
        echo "<td colspan='2' class='center' style='padding: 20px;'>";
        echo "<div id='qr_result_container' style='display:none;'>";

        echo "<h4 style='margin-top:0;'>Código QR:</h4>";
        echo "<div id='qr_code_image_wrapper' style='display:inline-block; padding:20px; background:white; border: 1px solid #ccc; border-radius: 8px;'><div id='qr_code_image'></div></div>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";

        echo "</table>";
        echo "</div>";

        // Require QRCode JS
        echo "<script src='" . $plugin_url . "/js/qrcode.min.js'></script>";

        echo "<script>
        var default_url = " . json_encode($default_url) . ";

        function generateQR() {
            var url = document.getElementById('qr_url').value.trim();
            if (url === '') { url = default_url; }
            var tag = document.getElementById('qr_tag').value.trim();
            var login = document.getElementById('qr_login').value.trim();
            var password = document.getElementById('qr_password').value; // Keep spaces if any
            var asset = document.getElementById('qr_asset_itemtype').value;
            var auto_inv = document.getElementById('qr_auto_inv').value;
            var frequency = document.getElementById('qr_frequency').value;

            var dataObj = {
                'URL': url,
                'TAG': tag,
                'LOGIN': login,
                'PASSWORD': password,
                'ASSET_ITEMTYPE': asset,
                'ANDROID_AUTOMATIC_INVENTORY': auto_inv,
                'ANDROID_FREQUENCY': frequency
            };

            var jsonString = JSON.stringify(dataObj);
            
            // Encode properly (supports utf-8 without breaking base64)
            var base64String = btoa(unescape(encodeURIComponent(jsonString)));

            document.getElementById('qr_result_container').style.display = 'block';

            var qrContainer = document.getElementById('qr_code_image');
            qrContainer.innerHTML = '';
            
            new QRCode(qrContainer, {
                text: base64String,
                width: 256,
                height: 256,
                colorDark : '#000000',
                colorLight : '#ffffff',
                correctLevel : QRCode.CorrectLevel.L
            });
        }

        function clearQR() {
            document.getElementById('qr_url').value = '';
            document.getElementById('qr_tag').value = '';
            document.getElementById('qr_login').value = '';
            document.getElementById('qr_password').value = '';
            document.getElementById('qr_asset_itemtype').value = 'Phone';
            document.getElementById('qr_auto_inv').value = '1';
            document.getElementById('qr_frequency').value = 'Week';
            
            document.getElementById('qr_result_container').style.display = 'none';
            document.getElementById('qr_code_image').innerHTML = '';
        }
        </script>";
    }
}
