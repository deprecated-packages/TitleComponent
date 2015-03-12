# Title Component

[![Build Status](https://img.shields.io/travis/Zenify/TitleComponent.svg?style=flat-square)](https://travis-ci.org/Zenify/TitleComponent)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/TitleComponent.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/TitleComponent)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Zenify/TitleComponent.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/TitleComponent)
[![Downloads this Month](https://img.shields.io/packagist/dm/zenify/title-component.svg?style=flat-square)](https://packagist.org/packages/zenify/title-component)
[![Latest stable](https://img.shields.io/packagist/v/zenify/title-component.svg?style=flat-square)](https://packagist.org/packages/zenify/title-component)


## Install

Via Composer:

```sh
$ composer require zenify/title-component
```

Register extension in `config.neon`:

```neon
extensions:
	- Zenify\TitleComponent\DI\TitleExtension
```


## Usage

Inject to presenter

```php
class Presenter ...
{

	/**
	 * @inject
	 * @var Zenify\TitleComponent\TitleControlFactory
	 */
	public $titleControlFactory;


	/**
	 * @return Zenify\TitleComponent\TitleControl
	 */
	protected function createComponentTitle()
	{
		return $this->titleControlFactory->create();
	}

}
```

Render in template

```smarty
<head>
	...
	{control title}
</head>
```

### Add title

Via annotation

```php
class HomepagePresenter ...
{

	/**
	 * @title Contact us
	 */
	public function renderContact()
	{
	}

}
```

Or via method

```php
class ProductPresenter ...
{

	public function startup()
   	{
   	    // set main title for whole app
   		$this['title']->set('Zenify');
		parent::startup();
   	}


	/**
	 * @param int
	 */
	public function renderDetail($id)
	{
		$product = ...($id);
		$this['title']->append('Detail of ' . $product->name);

		// change separator if you like
		$this['title']->setSeparator(' - ');
	}

}
```

This will result in:

```
Zenify - Detail of product ...
```

### Translator supported

```php
class HomepagePresenter ...
{

	/**
	 * @title homepage.contact.title
	 */
	public function renderContact()
	{
	}


	/**
	 * @param string
	 */
	public function renderDetail($name)
	{
		$this['title']->set(['user.detail.name', NULL, ['name' => $name]]);
	}

}
```
