# Netlte > UI

UI helpers and abstract classes mainly used in this framework. But you can use them too!

## Container a.k.a IContainer
Extends standard `Nette\ComponentModel\Container`.
* You can show&hide sub-components by `showComponent(string $name)` & `hideComponent(string $name)` but they can still receive signal and all other staff.
    * You can check if sub-component is hidden by `isComponentHidden(string $name)`
    * Even sub-component is not already set! - Great for modular systems
    
### RenderableContainer a.k.a IRenderableContainer
Extending `Netlte\UI\Container` with `render()` method.

## AbstractControl
Extends standard `Nette\Application\UI\Control`.
* You can set template file before internal control's template is initialized by `setTemplateFile()`.
* You can set translator before internal control's template is initialized by `setTranslator()`.
* You can show&hide sub-components same way like `Netlte\UI\Container`
    
**!!! Showing&Hiding sub-components MUST BE solved by parent control's template see tests and RenderableContainer !!!**

## HtmlControl
Easy graphical control expecting only `Nette\Utils\Html` instance as parameter.
* You can use it as html wrapper (Example: `<div class="row"></div>`) for bulk of components.
* Or you use it as OOP UI constructor for things like headings, paragraphs etc.
* You can define if Html children should render before or after sub-components by `$childrenFirst` property and `RENDER_CHILDREN_*` constants
* You can define final sourcecode indent by `(int) $indent` property
