# Prestashop extra hook isolation
This module controller will display your extra hook in a separate for easier developement

## Usage
- Copy the file ProductDev.php to the folder /modules/yourmodule/controllers/admin/
- Add this upgrade code or just excute it once in your module constructor
```php
$languages = Language::getLanguages();

$tab = new Tab();

foreach ($languages as $lang) {
    $tab->name[$lang['id_lang']] = 'Product Dev';
}

$tab->class_name = 'ProductDev';
$tab->module = $this->module->name;
$tab->active = 1;
$tab->add();
```
- Open the controller page using this link 
```text
.../[backoffice]/index.php?controller=DsnProductDev&id_product=1
```

## More
- To get the link to the dev page, you can use this code
```php
$dev_link = $this->context->link->getAdminLink('ProductDev', true, array(), array(
    'id_product' => $id_product
));
```
- You can then display this link in your extra template for easy access
- Don't forget to hide the link from your customer, they don't need to see it, it's for dev only