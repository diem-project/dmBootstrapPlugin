<?php

class sfWidgetFormSchemaFormatterBootstrap extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<div class=\"control-group\">\n  %error%\n  %label%\n  <div class=\"controls\">%field%\n  %help%</div>\n%hidden_fields%</div>\n",
    $errorListFormatInARow     = "<div class=\"alert alert-error\">\n<ul class=\"error_list\">\n%errors%  </ul>\n</div>\n",
    $errorRowFormatInARow      = "    <li>%error%</li>\n",
    $namedErrorRowFormatInARow = "    <li><b>%name%:</b> %error%</li>\n",
    $errorRowFormat  = "<div class=\"alert alert-error\">\n%errors%</div>\n",
    $helpFormat      = '<p class="text-info">%help%</p>',
    $decoratorFormat = "\n  %content%";


  /**
   * Generates a label for the given field name.
   *
   * @param  string $name        The field name
   * @param  array  $attributes  Optional html attributes for the label tag
   *
   * @return string The label tag
   */
  public function generateLabel($name, $attributes = array())
  {

    $labelName = $this->generateLabelName($name);

    if (false === $labelName)
    {
      return '';
    }

    $attributes['class'] = dmArray::toHtmlCssClasses(
      empty($attributes['class'])
      ? array()
      : array_merge((array) $attributes['class'], array())
    );

    if (is_string($attributes['class'])) {
      $attributes['class'] = trim(str_replace('  ', ' ', str_replace('label', '', $attributes['class'])));
    } elseif(is_array($attributes['class'])) {
      if ($labelPos = array_search('label', $attributes['class'])) {
        unset($attributes['class'][$labelPos]);
      }
    }

//    $attributes['class'] = array_unique($attributes['class']);

//    $attributes = array_merge($attributes, array('class' => 'control-label'));

    if (!isset($attributes['for']))
    {
      $attributes['for'] = $this->widgetSchema->generateId($this->widgetSchema->generateName($name));
    }

    return $this->widgetSchema->renderContentTag('label', $labelName, $attributes);
  }


}


