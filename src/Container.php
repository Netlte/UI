<?php declare(strict_types = 1);

namespace Netlte\UI;

use Nette\ComponentModel\Container as NetteContainer;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/ui
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class Container extends NetteContainer implements IContainer {

	use TContainer;

}