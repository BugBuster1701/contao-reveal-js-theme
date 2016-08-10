<?php

namespace BugBuster\RevealJs\Theme;

class Hooks
{
    public function loadLayoutDca(\PageModel $dc)
    {
        $layout = \Database::getInstance()
                           ->prepare('SELECT * FROM tl_layout WHERE id=?')
                           ->execute($dc->id);

        if ($layout->useRevealJs) 
        {
            Loader::load();

            // {title_legend},name;
            // {header_legend},rows;
            // {column_legend},cols;
            // {sections_legend:hide},sections,sPosition;
            // {webfonts_legend:hide},webfonts;
            // {style_legend},framework,stylesheet,external;
            // {feed_legend:hide},newsfeeds,calendarfeeds;
            // {modules_legend},modules;
            // {expert_legend:hide},template,doctype,viewport,titleTag,cssClass,onload,head;
            // {jquery_legend},addJQuery;
            // {mootools_legend},addMooTools;
            // {script_legend:hide},analytics,script;
            // {static_legend},static'

            \MetaPalettes::appendBefore(
                'tl_layout',
                'default',
                'expert',
                array(
                    'revealJs' => array(
                        'revealJsTheme',
                        'revealJsSize',
                        'revealJsMargin',
                        'revealJsScale',
                        'revealJsControls',
                        'revealJsProgress',
                        'revealJsSlideNumber',
                        'revealJsHistory',
                        'revealJsKeyboard',
                        'revealJsOverview',
                        'revealJsCenter',
                        'revealJsTouch',
                        'revealJsLoop',
                        'revealJsRtl',
                        'revealJsFragments',
                        'revealJsEmbedded',
                        'revealJsAutoSlide',
                        'revealJsAutoSlideStoppable',
                        'revealJsMouseWheel',
                        'revealJsHideAddressBar',
                        'revealJsPreviewLinks',
                        'revealJsTransition',
                        'revealJsTransitionSpeed',
                        'revealJsBackgroundTransition',
                        'revealJsViewDistance'
                    )
                )
            );

            \MetaPalettes::removeFields(
                'tl_layout',
                'default',
                array('sections', 'sPosition', 'static')
            );
        }
    }

    public function saveLayout($dc)
    {
        $layout = \Database::getInstance()
                           ->prepare('SELECT * FROM tl_layout WHERE id=?')
                           ->execute($dc->id);

        if ($layout->useRevealJs) 
        {
            $update = array();

            if ($layout->sections) {
                $update['sections'] = '';
            }
            if (count(deserialize($layout->framework, true))) {
                $update['framework'] = serialize(array());
            }
            if (count(deserialize($layout->newsfeeds, true))) {
                $update['newsfeeds'] = serialize(array());
            }
            if (count(deserialize($layout->calendarfeeds, true))) {
                $update['calendarfeeds'] = serialize(array());
            }
            if ($layout->template == 'fe_page') {
                $update['template'] = 'fe_reveal';
            }
            if ($layout->addJQuery) {
                $update['addJQuery'] = '';
            }
            if ($layout->addMooTools) {
                $update['addMooTools'] = '';
            }
            if ($layout->static) {
                $update['static'] = '';
            }
            if ($layout->viewport == '') {
            	$update['viewport'] = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui';
            }
            

            if (count($update)) {
                \Database::getInstance()
                         ->prepare('UPDATE tl_layout %s WHERE id=?')
                         ->set($update)
                         ->execute($dc->id);
            }
        }
    }

    public function loadArticleDca($dc)
    {
        $layout  = null;
        $article = \ArticleModel::findByPk($dc->id);
        $page    = \PageModel::findWithDetails($article->pid);

        while (!$layout && $page) {
            if ($page->includeLayout) {
                $layout = \LayoutModel::findByPk($page->layout);
            } else {
                $page = \PageModel::findWithDetails($page->pid);
            }
        }

    }

    public function getArticleLabel($row, $label)
    {
        $page   = \PageModel::findWithDetails($row['pid']);
        $layout = $page->getRelated('layout');

        $callback = $GLOBALS['TL_DCA']['tl_article']['list']['label']['reveal_original_label_callback'];
        if (is_array($callback)) 
        {
            $callback[0] = \System::importStatic($callback[0]);
        }
        $label = call_user_func($callback, $row, $label);

        if ($layout->useRevealJs) 
        {
            $pages = 0;
            $slide  = 0;
            
            $predecessors = \ArticleModel::findBy(
                            array('pid = ?'  , 'sorting <= ?'),
                            array($row['pid'], $row['sorting']),
                            array('order' => 'sorting')
                        );

            if ($predecessors) 
            {
                $slide = $predecessors->count();
            }
            
            $pages = \ContentModel::countPublishedByPidAndTable($row['id'], 'tl_article');

            $label .= ' ' . sprintf($GLOBALS['TL_LANG']['tl_article']['revealSlideNumber'], $slide, $pages);
        }
        
        return $label;
    }

    public function getPageLayout(\PageModel $page, \LayoutModel $layout, \PageRegular $pageRegular)
    {
        unset($page); // argument is never used 
        if ($layout->useRevealJs) 
        {
            Loader::load();

            $basePath = $GLOBALS['TL_CONFIG']['revealJsPath'] . '/' . $GLOBALS['TL_CONFIG']['revealJsVersion'];
            $cssPath  = $basePath . '/css/';
            $jsPath   = $basePath . '/js/';
            $libPath  = $basePath . '/lib/';
            

            if (!is_array($GLOBALS['TL_CSS'])) {
                $GLOBALS['TL_CSS'] = (array) $GLOBALS['TL_CSS'];
            }

            if ($layout->revealJsTheme) {
                array_unshift($GLOBALS['TL_CSS'], $cssPath . 'theme/' . $layout->revealJsTheme . '.css');
            }

            array_unshift(
                $GLOBALS['TL_CSS'],
                $libPath . 'css/zenburn.css'
            );
            
            array_unshift(
                $GLOBALS['TL_CSS'],
                $cssPath . 'reveal' . ($GLOBALS['TL_CONFIG']['revealJsUseMinified'] ? '.min' : '') . '.css'
            );
            
            if (!is_array($GLOBALS['TL_JAVASCRIPT'])) {
                $GLOBALS['TL_JAVASCRIPT'] = (array) $GLOBALS['TL_JAVASCRIPT'];
            }

            array_unshift(
                $GLOBALS['TL_JAVASCRIPT'],
                $jsPath . 'reveal' . ($GLOBALS['TL_CONFIG']['revealJsUseMinified'] ? '.min' : '') . '.js'
            );

            array_unshift(
                $GLOBALS['TL_JAVASCRIPT'],
                $libPath . 'js/head.min.js'
            );
            
            if (!is_array($GLOBALS['TL_BODY'])) {
                $GLOBALS['TL_BODY'] = (array) $GLOBALS['TL_BODY'];
            }

            $options_controls             = (int) $layout->revealJsControls;
            $options_progress             = (int) $layout->revealJsProgress;
            $options_slideNumber          = (int) $layout->revealJsSlideNumber;
            $options_history              = (int) $layout->revealJsHistory;
            $options_keyboard             = (int) $layout->revealJsKeyboard;
            $options_overview             = (int) $layout->revealJsOverview;
            $options_center               = (int) $layout->revealJsCenter;
            $options_touch                = (int) $layout->revealJsTouch;
            $options_loop                 = (int) $layout->revealJsLoop;
            $options_rtl                  = (int) $layout->revealJsRtl;
            $options_fragments            = (int) $layout->revealJsFragments;
            $options_embedded             = (int) $layout->revealJsEmbedded;
            $options_autoSlide            = (int) $layout->revealJsAutoSlide;
            $options_autoSlideStoppable   = (int) $layout->revealJsAutoSlideStoppable;
            $options_mouseWheel           = (int) $layout->revealJsMouseWheel;
            $options_hideAddressBar       = (int) $layout->revealJsHideAddressBar;
            $options_previewLinks         = (int) $layout->revealJsPreviewLinks;
            $options_transition           = (string) $layout->revealJsTransition;
            $options_transitionSpeed      = (string) $layout->revealJsTransitionSpeed;
            $options_backgroundTransition = (string) $layout->revealJsBackgroundTransition;
            $options_viewDistance         = (int) $layout->revealJsViewDistance;
            

            $size  = deserialize($layout->revealJsSize, true);
            $scale = deserialize($layout->revealJsScale, true);

            $options_width    = 960;
            $options_height   = 700;
            $options_margin   = (double) '0.1';
            $options_minScale = (double) '0.2';
            $options_maxScale = (double) '1.5';
            
            if (strlen($size[0])) {
                $options_width = (int) $size[0];
            }
            if (strlen($size[1])) {
                $options_height = (int) $size[1];
            }
            if (strlen($layout->revealJsMargin)) {
                $options_margin = (double) $layout->revealJsMargin;
            }
            if (strlen($scale[0])) {
                $options_minScale = (double) $scale[0];
            }
            if (strlen($scale[1])) {
                $options_maxScale = (double) $scale[1];
            }

            $GLOBALS['TL_BODY'][] = <<<EOF
<script>
Reveal.initialize({

    // Display controls in the bottom right corner
    controls: $options_controls,

    // Display a presentation progress bar
    progress: $options_progress,

    // Display the page number of the current slide
    slideNumber: $options_slideNumber, // default: false,

    // Push each slide change to the browser history
    history: $options_history, // default: false

    // Enable keyboard shortcuts for navigation
    keyboard: $options_keyboard,

    // Enable the slide overview mode
    overview: $options_overview,

    // Vertical centering of slides
    center: $options_center,

    // Enables touch navigation on devices with touch input
    touch: $options_touch,

    // Loop the presentation
    loop: $options_loop,

    // Change the presentation direction to be RTL
    rtl: $options_rtl,

    // Turns fragments on and off globally
    fragments: $options_fragments,

    // Flags if the presentation is running in an embedded mode,
    // i.e. contained within a limited portion of the screen
    embedded: $options_embedded,

    // Flags if we should show a help overlay when the questionmark
    // key is pressed
    help: true,

    // Flags if speaker notes should be visible to all viewers
    showNotes: false,

    // Number of milliseconds between automatically proceeding to the
    // next slide, disabled when set to 0, this value can be overwritten
    // by using a data-autoslide attribute on your slides
    autoSlide: $options_autoSlide,

    // Stop auto-sliding after user input
    autoSlideStoppable: $options_autoSlideStoppable,

    // Enable slide navigation via mouse wheel
    mouseWheel: $options_mouseWheel,

    // Hides the address bar on mobile devices
    hideAddressBar: $options_hideAddressBar,

    // Opens links in an iframe preview overlay
    previewLinks: $options_previewLinks,

    // Transition style
    transition: '$options_transition', // default/none/fade/->slide<-/convex/concave/zoom

    // Transition speed
    transitionSpeed: '$options_transitionSpeed', // default/fast/slow

    // Transition style for full page slide backgrounds
    backgroundTransition: '$options_backgroundTransition', // none/fade/slide/convex/concave/zoom

    // Number of slides away from the current that are visible
    viewDistance: $options_viewDistance,

    // Parallax background image
    parallaxBackgroundImage: '', // e.g. "'https://s3.amazonaws.com/hakim-static/reveal-js/reveal-parallax-1.jpg'"

    // Parallax background size
    parallaxBackgroundSize: '', // CSS syntax, e.g. "2100px 900px"

    // Number of pixels to move the parallax background per slide
    // - Calculated automatically unless specified
    // - Set to 0 to disable movement along an axis
    parallaxBackgroundHorizontal: null,
    parallaxBackgroundVertical: null,
    
    // The "normal" size of the presentation, aspect ratio will be preserved
    // when the presentation is scaled to fit different resolutions. Can be
    // specified using percentage units.
    width: $options_width, //960,
    height: $options_height, //700,

    // Factor of the display size that should remain empty around the content
    margin: $options_margin, //0.1,

    // Bounds for smallest/largest possible scale to apply to content
    minScale: $options_minScale, //0.2,
    maxScale: $options_maxScale, //1.5,
    
    dependencies: [
        // Cross-browser shim that fully implements classList - https://github.com/eligrey/classList.js/
        { src: '$basePath/lib/js/classList.js', condition: function() { return !document.body.classList; } },

        // Interpret Markdown in <section> elements
        { src: '$basePath/plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
        { src: '$basePath/plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },

        // Syntax highlight for <code> elements
        { src: '$basePath/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },

        // Zoom in and out with Alt+click
        { src: '$basePath/plugin/zoom-js/zoom.js', async: true },

        // Speaker notes
        { src: '$basePath/plugin/notes/notes.js', async: true } //,

        // MathJax
        //{ src: '$basePath/plugin/math/math.js', async: true }
    ]
});
</script>
EOF;
            $GLOBALS['TL_HOOKS']['parseTemplate'][] = array('BugBuster\RevealJs\Theme\Hooks', 'parseTemplate');
        }
    }

    public function parseTemplate(\Template $template)
    {
        if (substr($template->getName(), 0, 3) == 'ce_' && $template->imgSize) {
            $template->imgSize = '';
        }
    }
}
