<?php

$GLOBALS['TL_CONFIG']['revealJsVersion']     = '3.3.0';
$GLOBALS['TL_CONFIG']['revealJsPath']        = 'assets/reveal-js';
// reveal.js 3.3.0 has no min version
// minimize with yuicompressor is not functional
$GLOBALS['TL_CONFIG']['revealJsUseMinified'] = false;

$GLOBALS['TL_HOOKS']['getPageLayout'][] = array('BugBuster\RevealJs\Theme\Hooks', 'getPageLayout');
