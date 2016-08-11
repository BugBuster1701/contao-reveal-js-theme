<?php

namespace BugBuster\RevealJs\Theme;

class Loader
{
    static public function load()
    {
        \TemplateLoader::addFiles(
            array
            (
                'fe_reveal'   => 'system/modules/reveal-js/templates',
                'mod_article' => 'system/modules/reveal-js/templates',
                'ce_text'     => 'system/modules/reveal-js/templates',
                'ce_markdown' => 'system/modules/reveal-js/templates',
            )
        );
    }
}
