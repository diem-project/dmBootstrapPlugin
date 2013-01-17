<?php
/** @var dmFrontLayoutHelper */
$helper = $sf_context->get('layout_helper');

echo
$helper->renderDoctype(),
$helper->renderHtmlTag(),

  "\n<head>\n",
    $helper->renderHead(),
  "\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n",
  "\n</head>\n",

  $helper->renderBodyTag(),

    $sf_content,

    $helper->renderEditBars(),

    $helper->renderJavascriptConfig(),
    $helper->renderJavascripts(),
    $helper->renderGoogleAnalytics(),

  "\n</body>\n",

"\n</html>";