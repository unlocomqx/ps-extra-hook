<?php

class ProductDevController extends ModuleAdminController
{

    /** @var YourModuleClass */
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
