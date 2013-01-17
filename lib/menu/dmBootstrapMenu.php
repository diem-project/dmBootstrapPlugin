<?php

class dmBootstrapMenu extends dmMenu
{

  public function getDefaultOptions()
  {
    return array(
      'ul_class'          => null,
      'li_class'          => null,
      'show_id'           => false,
      'show_children'     => true,
      'translate'         => true
    );
  }

  public function render()
  {
    $html = '';

    if ($this->checkUserAccess() && $this->hasChildren())
    {
      $html = $this->renderUlOpenTag();

      foreach ($this->children as $child)
      {
        $html .= $child->renderChild();
      }

      $html .= '</ul>
          </div>
        </div>
      </div>
    </div>
';
    }

    return $html;
  }

  public function renderChildren()
  {
    $html = '';

    if ($this->checkUserAccess() && $this->hasChildren())
    {
      $html = $this->renderUlChildrenOpenTag();
//      if (null !== $link) {
//        $this->addChild(str_replace('<b class="caret"></b>', '', $link->getText()), $link->getHref());
//        array_unshift($this->children, $link);
//        $html .= $this->renderLiOpenTag();
//        $html .= $this->renderLink();
//        $html .= '</li>';
//      }
      foreach ($this->children as $child)
      {
        $html .= $child->renderChild();
      }
      $html .= '</ul>';
    }

    return $html;
  }

  protected function renderUlOpenTag()
  {
    $class  = $this->getOption('ul_class');
    $id     = $this->getOption('show_id') ? dmString::slugify($this->name.'-menu') : null;

    return '
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container'.($this->getOption('layout') ? '-' . $this->getOption('layout') : '').'">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="nav-collapse collapse">
<ul'.($id ? ' id="'.$id.'"' : '').' class="nav'.($class ? ' ' . $class : '').'"'.'>';
  }

  protected function renderUlChildrenOpenTag()
  {
    $class  = $this->getOption('ul_class');
    $id     = $this->getOption('show_id') ? dmString::slugify($this->name.'-menu') : null;

    return '<ul'.($id ? ' id="'.$id.'"' : '').' class="dropdown-menu'.($class ? ' ' . $class : '').'"'.'>';
  }


  public function renderChild()
  {
    $html = '';

    if ($this->checkUserAccess())
    {
      $html .= $this->renderLiOpenTag($this->hasChildren() && $this->getOption('show_children') ? 'dropdown' : '');

      $html .= $this->renderChildBody(($this->hasChildren() && $this->getOption('show_children')));

      if ($this->hasChildren() && $this->getOption('show_children'))
      {
        $html .= $this->renderChildren();
      }

      $html .= '</li>';
    }

    return $html;
  }

  protected function renderLiOpenTag($class = null)
  {
    $classes  = array();
    $id       = $this->getOption('show_id') ? dmString::slugify('menu-'.$this->getRoot()->getName().'-'.$this->getName()) : null;
    $link     = $this->getLink();

    if (null !== $class) {
      $classes[] = $class;
    }
    if ($this->isFirst())
    {
      $classes[] = 'first';
    }
    if ($this->isLast())
    {
      $classes[] = 'last';
    }
    if ($this->getOption('li_class'))
    {
      $classes[] = $this->getOption('li_class');
    }
    if($link && $link->isCurrent())
    {
      $classes[] = $link->getOption('current_class');
    }
    elseif($link && $link->isParent())
    {
      $classes[] = $link->getOption('parent_class');
    }

    return '<li'.($id ? ' id="'.$id.'"' : '').(!empty($classes) ? ' class="'.implode(' ', $classes).'"' : '').'>';
  }

  public function renderChildBody($dropdown = false)
  {
    if ($dropdown) {
      return $this->getLink() ? $this->renderLink($dropdown, array('class' => array('dropdown-toggle'), 'data-toggle' => 'dropdown')) : $this->renderLabel();
    } else {
      return $this->getLink() ? $this->renderLink() : $this->renderLabel();
    }
  }

  public function renderLink($dropdown = false, $attributes = array())
  {
    return $this->getLink()->text((!$this->getLink()->getPage()->getSlug()  ? '<i class="icon-home"></i> ' : '') . $this->__($this->getLabel()) . ($dropdown ? '<b class="caret"></b>' : ''))->currentSpan(false)->set($attributes)->render();
  }

  public function renderLabel()
  {
    return $this->__($this->getLabel());
  }

}