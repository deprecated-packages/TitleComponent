<?php

namespace ZenifyTests;

use Nette;


class LocalizedPresenter extends Nette\Application\UI\Presenter
{

	/**
	 * @inject
	 * @var \Zenify\TitleComponent\ControlFactory
	 */
	public $titleControlFactory;



	/**
	 * @title homepage.title.english
	 */
	public function renderHomepage()
	{
	}


	/**
	 * @param string $name
	 */
	public function renderUser($name)
	{
		$this['title']->set(array('user.detail.name', NULL, array(
			'name' => $name
		)));
	}


	/**
	 * @return \Zenify\TitleComponent\Control
	 */
	protected function createComponentTitle()
	{
		return $this->titleControlFactory->create();
	}


	/**
	 * We don't need templates for presenter
	 * @throws Nette\Application\AbortException
	 */
	public function sendTemplate()
	{
		$this->terminate();
	}

}
