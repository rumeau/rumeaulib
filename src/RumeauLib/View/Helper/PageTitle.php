<?php
/**
 * RumeauLib (https://github.com/rumeau/rumeaulib)
 *
 * @link      https://github.com/rumeau/rumeaulib for the canonical source repository
 * @copyright Copyright (c)
 * @license   http://opensource.org/licenses/MIT MIT License
 */
namespace RumeauLib\View\Helper;

use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\Translator\TranslatorAwareTrait;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\EscapeHtml;


/**
 * Class PageTitle
 * Adds an html page title
 *
 * @package RumeauLib\View\Helper
 * @method string pagetitle() pagetitle(string $title, string $subtitle = '', $escape = true) Adds an html page title
 */
class PageTitle extends AbstractHelper implements TranslatorAwareInterface
{
    use TranslatorAwareTrait;

    /**
     * Page title template
     */
    const PAGE_TITLE_TEMPLATE = '<div class="page-header"><h1>%s</h1>%s</div>';
    /**
     * Page subtitle template
     */
    const PAGE_SUBTITLE_TEMPLATE = '<small>%s</small>';

    /**
     * @var bool $escape Escape the title and subtitle
     */
    protected $escape;

    /**
     * @var EscapeHtml $escape Escape string helper
     */
    protected $escaper;

    /**
     * @param string $title    Page title
     * @param string $subtitle Page Subtitle
     * @param bool   $escape   Escape flag. Default: true
     *
     * @return string
     */
    public function __invoke($title, $subtitle = '', $escape = true)
    {
        $this->escape = (bool)$escape;

        $title    = (string)$title;
        $subtitle = (string)$subtitle;

        return $this->renderPageTitle($title, $subtitle);
    }

    /**
     * Render title string
     *
     * @param string $title    Page title string
     * @param string $subtitle Page subtitle string
     *
     * @return string $output
     */
    public function renderPageTitle($title, $subtitle = '')
    {
        if (null !== ($translator = $this->getTranslator())) {
            $title = $translator->translate($title, $this->getTranslatorTextDomain());
        }

        $title = ($this->escape) ? $this->escape($title) : $title;

        if (!empty($subtitle)) {
            $subtitle = $this->renderSubtitle($subtitle);
        }

        return sprintf(self::PAGE_TITLE_TEMPLATE, $title, $subtitle);
    }

    /**
     * Render the subtitle string
     *
     * @param $subtitle
     *
     * @return string
     */
    public function renderSubtitle($subtitle)
    {
        if (null !== ($translator = $this->getTranslator())) {
            $subtitle = $translator->translate($subtitle, $this->getTranslatorTextDomain());
        }

        if (empty($subtitle)) {
            return '';
        }

        $subtitle = ($this->escape) ? $this->escape($subtitle) : $subtitle;

        return sprintf(self::PAGE_SUBTITLE_TEMPLATE, $subtitle);
    }

    /**
     * Escape a string
     *
     * @param  string $string
     *
     * @return string
     */
    protected function escape($string)
    {
        if (!$this->escaper) {
            $this->escaper = $this->getView()->plugin('escapeHtml');
        }

        return $this->escaper->__invoke((string)$string);
    }
}
