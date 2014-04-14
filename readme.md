# Zenify/TitleComponent


## Requirements

This package requires PHP 5.4.

- [nette/nette](https://github.com/nette/nette/)


## Installation

The best way to install this package is using [Composer](http://getcomposer.org/):

```sh
$ composer require "zenify/title-component:@dev"
```

And register the factory in `config.neon`:

```neon
services:
	- Zenify\TitleComponent\UI\IControl
```


## Use

Inject to presenter

```php
class Presenter ... {

	/** @inject @var Zenify\TitleComponent\UI\IControl */
	public $titleControl;


	public function createComponentTitleControl()
	{
		return $this->titleControl->create();
	}

}
```

Render in template

```smarty
<head>
	...
	{control titleControl}
</head>
```

### Add title

Via annotation

```php
class HomepagePresenter ... {

	/**
	 * @title Contact us
	 */
	public function renderContact()
	{
	}

}
```

Or with direct access

```php
class ProductPresenter ... {

	public function renderDetail($id)
	{
		$product = ...($id);
		$this['titleControl']->setTitle('Detail of ' . $product->name);
	}

}
```

#### Translator supported


```php
class HomepagePresenter ... {

	/**
	 * @title homepage.cotact.title
	 */
	public function renderContact()
	{
	}

}
```
