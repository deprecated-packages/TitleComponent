# Zenify/TitleComponent


## Requirements

See section `require` in [composer.json](composer.json).


## Installation

The best way to +install this package is using [Composer](http://getcomposer.org/):

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

#### Add website brand

Also you can setup showing website brand after the title.

```php
class Presenter ... {

	public function createComponentTitle()
	{
		$control = $this->titleControl->create();
		$control->setBrand('Nette framework');
		return $control;
	}

}
```
