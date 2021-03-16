<?php declare(strict_types = 1);

namespace Netlte\UI;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/ui
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class RenderableContainer  extends Container implements IRenderableContainer {

	public function render(): void {
		foreach ($this->getComponents() as $component) {
			if (\in_array($component->getName(), $this->hidden, true)) continue;
			if (!\method_exists($component,'render')) continue;
			$component->render();
		}
	}

}