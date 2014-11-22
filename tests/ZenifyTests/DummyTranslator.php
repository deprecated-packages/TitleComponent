<?php

namespace ZenifyTests;

use Nette\Localization\ITranslator;


class DummyTranslator implements ITranslator
{
	/** @var array */
	private $translations = [
		'homepage.title.english' => 'Welcome home',
		'user.detail.name' => 'This is profile of %name%',
	];


	/**
	 * Translator in Kdyby\Translation style
	 * @see https://github.com/Kdyby/Translation/blob/master/src/Kdyby/Translation/Translator.php
	 *
	 * @param  string
	 * @param  int
	 * @return string
	 */
	public function translate($message, $count = NULL, array $parameters = [])
	{
		if ( ! isset($this->translations[$message])) {
			return $message;
		}

		$message = $this->translations[$message];

		if ($parameters) {
			$tmp = [];
			foreach ($parameters as $key => $val) {
				$tmp['%' . trim($key, '%') . '%'] = $val;
			}
			$parameters = $tmp;
			return strtr($message, $parameters);
		}

		return $message;
	}

}
