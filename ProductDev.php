<?php
/**
 * 2010-2020 Tuni-Soft
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * It is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize the module for your
 * needs please refer to
 * http://doc.prestashop.com/display/PS15/Overriding+default+behaviors
 * for more information.
 *
 * @author    Tuni-Soft
 * @copyright 2010-2020 Tuni-Soft
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class ProductDevController extends ModuleAdminController
{

    /** @var ModuleClass */
    public $module;

    public $bootstrap = true;

    private $id_product;

    public function __construct()
    {
        parent::__construct();
        $controller_name = 'AdminProducts';
        $_GET['controller'] = $_POST['controller'] = $_REQUEST['controller'] = $controller_name;
        $this->context->controller->controller_name = $controller_name;
        $this->id_product = (int)Tools::getValue('id_product');
    }

    public function setMedia($isNewTheme = true)
    {
        parent::setMedia($isNewTheme);
        $this->addJqueryPlugin(array('fancybox'));
        $this->addJS(_PS_JS_DIR_ . 'tiny_mce/tiny_mce.js');
        $this->addJS(_PS_JS_DIR_ . 'admin/tinymce.inc.js');
        $this->addJS(_PS_JS_DIR_ . 'admin/tinymce_loader.js');
    }

    public function initContent()
    {
        $extra_content = $this->module->hookDisplayAdminProductsExtra(array(
            'id_product' => $this->id_product,
        ));

        $cls = "module-render-container module-{$this->module->name}";
        $content = "
            <style>
              body {
                background-color:#fff;
              }
              .module-render-container {
                width: 100%;
                margin: 5px !important;
              }
              #header, .page-head, #ajax_confirmation, .nav-bar, #footer {
                display: none !important;
              }
            </style>
            <input type='hidden' id='form_id_product' value='{$this->id_product}'>
            <div id='module_{$this->module->name}' class='{$cls}'>
              {$extra_content}
            </div>";
        $this->context->smarty->assign(array(
            'content' => $content,
        ));
    }
}
