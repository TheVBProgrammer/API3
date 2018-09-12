yii2-theme-devoops / Yii2 extension
=

Yii2 Admin theme modify from **[DevOOPS](https://github.com/nnmware/devoops)** bootstrap 3 template

# Installation

## Install via composer:
```
  composer require "jucksearm/yii2-theme-devoops"
```
OR add this to your composer.json require section

```json
  "jucksearm/yii2-theme-devoops": "*",
```
## Install via zip:

download file https://github.com/jucksearm/yii2-theme-devoops/archive/master.zip

extract file to `vendor` folder as:
```php
   vendor
   |- jucksearm
     |- yii2-theme-devoops
       | ......
```

# How to use

Once the extension is installed, you can have a **preview** by reconfiguring the path mappings of the view component:

For Yii 2 [Advanced Application Template](https://github.com/yiisoft/yii2-app-advanced) or [Basic Application Template](https://github.com/yiisoft/yii2-app-basic)

```php
'components' => [
    'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/jucksearm/yii2-theme-devoops/views'
             ],
         ],
    ],
],
```

## [Components](Components.md)

Detailed description of all Components.

## [Widgets](Widgets.md)

Detailed description of all widgets.
