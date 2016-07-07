<?php

$GLOBALS['TL_DCA']['tl_layout']['config']['onload_callback'][] = array(
    'BugBuster\RevealJs\Theme\Hooks',
    'loadLayoutDca'
);

$GLOBALS['TL_DCA']['tl_layout']['config']['onsubmit_callback'][] = array(
    'BugBuster\RevealJs\Theme\Hooks',
    'saveLayout'
);

MetaPalettes::appendFields('tl_layout', 'default', 'title', array('useRevealJs'));

$GLOBALS['TL_DCA']['tl_layout']['fields']['useRevealJs'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['useRevealJs'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array('submitOnChange' => true),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsPrint'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsPrint'],
    'default'   => '',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => array('pdf', 'paper'),
    'eval'      => array('includeBlankOption' => true),
    'sql'       => "char(5) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsTheme'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsTheme'],
    'default'   => 'black',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => array('beige', 'black', 'blood', 'league', 'moon', 'night', 'serif', 'simple', 'sky', 'solarized', 'white'),
    'eval'      => array('includeBlankOption' => true),
    'sql'       => "varchar(64) NOT NULL default 'black'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsSize'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsSize'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('multiple' => true, 'size' => 2, 'rgxp' => 'digit'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsMargin'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsMargin'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('rgxp' => 'digit'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsScale'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsScale'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('multiple' => true, 'size' => 2, 'rgxp' => 'digit'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsControls'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsControls'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsProgress'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsProgress'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsSlideNumber'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsSlideNumber'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsHistory'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsHistory'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsKeyboard'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsKeyboard'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsOverview'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsOverview'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsCenter'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsCenter'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsTouch'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsTouch'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsLoop'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsLoop'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsRtl'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsRtl'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsFragments'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsFragments'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsEmbedded'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsEmbedded'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsAutoSlide'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsAutoSlide'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('rgxp' => 'digit'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsAutoSlideStoppable'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsAutoSlideStoppable'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsMouseWheel'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsMouseWheel'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsHideAddressBar'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsHideAddressBar'],
    'default'   => true,
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsPreviewLinks'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsPreviewLinks'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsTransition'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsTransition'],
    'default'   => 'default',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => array('default', 'cube', 'page', 'concave', 'zoom', 'linear', 'fade'),
    'eval'      => array('includeBlankOption' => true),
    'sql'       => "varchar(16) NOT NULL default 'default'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsTransitionSpeed'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsTransitionSpeed'],
    'default'   => 'default',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => array('default', 'fast', 'slow'),
    'sql'       => "char(7) NOT NULL default 'default'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsBackgroundTransition'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsBackgroundTransition'],
    'default'   => 'default',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => array('default', 'slide', 'concave', 'convex', 'zoom'),
    'eval'      => array('includeBlankOption' => true),
    'sql'       => "varchar(16) NOT NULL default 'default'"
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['revealJsViewDistance'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_layout']['revealJsViewDistance'],
    'default'   => 3,
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('rgxp' => 'digit'),
    'sql'       => "int(10) unsigned NOT NULL default '3'"
);
