<?php


namespace Netlte\UI;


use Nette\ComponentModel\IContainer as INetteContainer;

interface IContainer extends INetteContainer {

	public function hideComponent(string $name): IContainer;

	public function showComponent(string $name): IContainer;

	public function render(): void;

}