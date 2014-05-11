# Zenify/TitleComponent


## Requirements

This package requires PHP 5.4.

- [nette/application](https://github.com/nette/application/)


## Installation

The best way to install this package is using [Composer](http://getcomposer.org/):

```sh
$ composer require zenify/title-component:@dev
```

And register the factory in `config.neon`:

```neon
services:
	- Zenify\TitleComponent\IControl
```


## Use

Inject to presenter

```php
class Presenter ... {

	/** @inject @var Zenify\TitleComponent\IControl */
	public $titleControl;


	public function createComponentTitle()
	{
		return $this->titleControl->create();
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
		$this['title']->setTitle('Detail of ' . $product->name);
	}

}
```

#### Translator supported


```php
class HomepagePresenter ... {

	/**
	 * @title homepage.contact.title
	 */
	public function renderContact()
	{
	}

}
```
