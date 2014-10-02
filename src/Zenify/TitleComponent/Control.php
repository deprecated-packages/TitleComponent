<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\TitleComponent;

use Nette;


/**
 * @property-read \Nette\Bridges\ApplicationLatte\Template|\stdClass $template
 * @method Control  setSeparator()
 */
class Control extends Nette\Application\UI\Control
{

	/**
	 * @var array
	 */
	private $items = array();

	/**
	 * @var string
	 */
	private $separator = ' | ';

	/**
	 * @var Nette\Localization\ITranslator
	 */
	private $translator;


	public function __construct(Nette\Localization\ITranslator $translator = NULL)
	{
		$this->translator = $translator;
	}


	/**
	 * @param string
	 */
	public function prepend($title)
	{
		array_unshift($this->items, $title);
	}


	/**
	 * @param string
	 */
	public function append($title)
	{
		array_push($this->items, $title);
	}


	/**
	 * @param string|array
	 */
	public function set($title)
	{
		$this->items = array();
		$this->append($title);
	}


	public function attached($presenter)
	{
		parent::attached($presenter);

		$parser = new AnnotationParser;
		if ($title = $parser->detectAndExtract($presenter)) {
			$this->set($title);
		}
	}


	/**
	 * @param string|NULL $mainTitle
	 */
	public function render($mainTitle = NULL)
	{
		if ($mainTitle) {
			$this->prepend($mainTitle);
		}

		$this->template->title = $this->getTitle();
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}


	/**
	 * @return string
	 */
	private function getTitle()
	{
		$this->items = array_filter($this->items);
		if ($this->translator) {
			$this->items = array_map(array($this, 'translate'), $this->items);
		}
		return implode($this->separator, $this->items);
	}


	/**
	 * @param string $title
	 * @return mixed|string
	 */
	private function translate($title)
	{
		if (is_array($title)) {
			$title = call_user_func_array(array($this->translator, 'translate'), $title);

		} else {
			$title = $this->translator->translate($title);
		}

		return $title;
	}

}
