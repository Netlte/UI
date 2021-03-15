<?php declare(strict_types = 1);

namespace Netlte\UI;


use Nette\ComponentModel\IContainer as INetteContainer;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/ui
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
interface IContainer extends INetteContainer {

	public function hideComponent(string $name): IContainer;

	public function showComponent(string $name): IContainer;

	public function render(): void;

}