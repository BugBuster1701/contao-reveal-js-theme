<?php

$GLOBALS['TL_DCA']['tl_article']['config']['onload_callback'][] = array(
    'BugBuster\RevealJs\Theme\Hooks',
    'loadArticleDca'
);

$GLOBALS['TL_DCA']['tl_article']['list']['label']['reveal_original_label_callback'] =
    $GLOBALS['TL_DCA']['tl_article']['list']['label']['label_callback'];
$GLOBALS['TL_DCA']['tl_article']['list']['label']['label_callback']                 =
    array('BugBuster\RevealJs\Theme\Hooks', 'getArticleLabel');
