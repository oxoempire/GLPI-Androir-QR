<?php
define('PLUGIN_INVENTORYQR_VERSION', '1.0.0');

function plugin_init_inventoryqr()
{
    global $PLUGIN_HOOKS;
    $PLUGIN_HOOKS['csrf_compliant']['inventoryqr'] = true;

    Plugin::registerClass('PluginInventoryqrConfig', [
        'addtabon' => ['Config']
    ]);
}

function plugin_version_inventoryqr()
{
    return [
        'name'           => 'Android Inventory QR',
        'version'        => PLUGIN_INVENTORYQR_VERSION,
        'author'         => 'Idea Original: Manu Cabello | Ejecución de código: Antigravity & Gemini Pro',
        'license'        => 'GPLv2+',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => '10.0.0'
            ]
        ]
    ];
}

function plugin_inventoryqr_check_prerequisites()
{
    if (version_compare(GLPI_VERSION, '10.0.0', 'lt')) {
        echo "Requires GLPI >= 10.0.0";
        return false;
    }
    return true;
}

function plugin_inventoryqr_check_config()
{
    return true;
}
