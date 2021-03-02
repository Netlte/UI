<?php declare(strict_types = 1);

namespace Netlte\UI;

use Nette\ComponentModel\Container;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/navigation
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class BaseContainer  extends Container {

	/** @var string[] */
	private array $hidden = [];

	public function hideComponent(string $name): self {
		if (!\in_array($name, $this->hidden, true)) $this->hidden[] = $name;
		return $this;
	}

	public function showComponent(string $name): self {
		$key = \array_search($name, $this->hidden, true);
		if ($key !== false) unset($this->hidden[$key]);
		return $this;
	}

	public function render(): void {
		foreach ($this->getComponents() as $component) {
			if (\in_array($component->getName(), $this->hidden, true)) continue;
			if (!\method_exists($component,'render')) continue;
			$component->render();
		}
	}

}