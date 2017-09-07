Yii2 SEO Helper
===============
Set SEO variables (Title, Description etc) from every model;

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist warsztatweb/yii2-seo-helper "*"
```

or add

```
"warsztatweb/yii2-seo-helper": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by:

Attach the component in your config file:

```php
'components' => [
    'seo' => [
        'class' => 'warsztatweb\seo\Helper',
    ],
],
```

## Using

### Set SEO data
```php
echo Yii::$app->seo->set($model);
```

$model should have these attributes to work properly:

meta_title
meta_description
meta_keywords
h1
params[] eg: params["og:image"]

Module can handla other columns like title,name,nazwa,tytul,tyt for meta_title; columns like lead, description, desc, html for meta_description. It looks for column named baner, banner, thumb, image for automaticlay generated og:image property.

og tags are generated automaticaly based on meta_title, meta_desription

### SEO Meta based on route

//todo


### SEO Redirect
For enabling SEO Redirect add to configuration file 
```php
'errorHandler' => [
    'class' => 'warsztatweb\seo\Redirect',
],
```

Based on Amirax SEO Tools for Yii 2
https://github.com/Amirax/yii2-seo-tools

