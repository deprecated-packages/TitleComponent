# Zenify/TitleComponent

[![Build Status](https://travis-ci.org/Zenify/TitleComponent.svg?branch=master)](https://travis-ci.org/Zenify/TitleComponent)
[![Downloads this Month](https://img.shields.io/packagist/dm/zenify/title-component.svg)](https://packagist.org/packages/zenify/title-component)
[![Latest stable](https://img.shields.io/packagist/v/zenify/title-component.svg)](https://packagist.org/packages/zenify/title-component)


## Installation

To get the latest version run [Composer](http://getcomposer.org/) command:

```sh
$ composer require zenify/title-component
```

And register the factory in `config.neon`:

```neon
services:
	- Zenify\TitleComponent\ControlFactory
```


## Use

Inject to presenter

```php
class Presenter ...
{

	/**
	 * @inject
	 * @var Zenify\TitleComponent\ControlFactory
	 */
	public $titleControlFactory;


	/**
	 * @return Zenify\TitleComponent\Control
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

#### Translator supported

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
