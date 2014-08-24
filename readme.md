# Zenify/TitleComponent


## Installation

The best way to install this package is using [Composer](http://getcomposer.org/):

```sh
$ composer require zenify/title-component:@dev
```

And register the factory in `config.neon`:

```neon
services:
	- Zenify\TitleComponent\IControlFactory
```


## Use

Inject to presenter

```php
class Presenter ...
{

	/**
	 * @inject
	 * @var Zenify\TitleComponent\IControlFactory
	 */
	public $titleControlFactory;


	/**
	 * @return Zenify\TitleComponent\Control
	 */
	public function createComponentTitle()
	{
		return $this->titleControlFactory->create();
	}

}
```

or just use the trait:

```php
class Presenter ...
{
	use Zenify\TitleComponent\Application\TInjectComponent;
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

Even complex translations

```php
public function renderDetail($name)
{
	$this['title']->setTitle(['user.detail.name', NULL, ['name' => $name]]);
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
