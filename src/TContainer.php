<?php declare(strict_types = 1);

namespace Netlte\UI;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/ui
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
trait TContainer {

	/** @var string[] */
	protected array $hidden = [];

	public function hideComponent(string $name): IContainer {
		if (!\in_array($name, $this->hidden, true)) $this->hidden[] = $name;
		return $this;
	}

	public function showComponent(string $name): IContainer {
		$key = \array_search($name, $this->hidden, true);
		if ($key !== false) unset($this->hidden[$key]);
		return $this;
	}

	public function isComponentHidden(string $name): bool {
		return \in_array($name, $this->hidden, true);
	}
}