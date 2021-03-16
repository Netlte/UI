<?php declare(strict_types = 1);

namespace Netlte\UI;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/ui
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
interface IRenderableContainer extends IContainer {

	public function render(): void;

}