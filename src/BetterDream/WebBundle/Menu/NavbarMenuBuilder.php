<?php

namespace BetterDream\WebBundle\Menu;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Knp\Menu\FactoryInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

/**
 * NavbarMenuBuilder
 *
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class NavbarMenuBuilder extends AbstractNavbarMenuBuilder
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var array
     */
    protected $locales;

    /**
     * @param FactoryInterface    $factory
     * @param TranslatorInterface $translator
     */
    public function __construct(FactoryInterface $factory, TranslatorInterface $translator, array $locales)
    {
        parent::__construct($factory);

        $this->translator = $translator;
        $this->locales = $locales;
    }

    /**
     * {@inheritdoc}
     */
    public function createMainMenu(Request $request)
    {
        $getIconHtml = function($type) {
            return sprintf('<i class="icon-%s icon-white"></i> ', $type);
        };

        $menu = $this->factory->createItem('root');
        $menu->setCurrentUri($request->getRequestUri());
        $menu->setChildrenAttribute('class', 'nav');
        $menu->setExtra('safe_label', true);

        $menu->addChild($getIconHtml('home') . $this->translator->trans('titles.home'), array('route' => 'betterdream_web_main_index'));
        $menu->addChild($getIconHtml('question-sign') . $this->translator->trans('titles.help'), array('route' => 'betterdream_web_main_help'));
        $menu->addChild($getIconHtml('envelope') . $this->translator->trans('titles.contact'), array('route' => 'betterdream_web_main_contact'));
        $menu->addChild($getIconHtml('info-sign') . $this->translator->trans('titles.about'), array('route' => 'betterdream_web_main_about'));

        $dropDownLabel = $getIconHtml('thumbs-up') . $this->translator->trans('titles.social') . ' <b class="caret"></b>';
        $dropDown = $this->createDropdownMenuItem($menu, $dropDownLabel);

        $socialTypes = array('facebook', 'twitter');
        foreach ($socialTypes as $type) {
            $url = $this->translator->trans(sprintf('social.%s.uri', $type));
            $label = $this->translator->trans(sprintf('social.%s.label', $type));
            $html = sprintf('<a href="%s" target="_blank">%s</a>', $url, $label);
            $child = $dropDown->addChild($html);
            $child->setExtra('safe_label', true);
        }

        foreach ($menu->getChildren() as $child) {
            $child->setExtra('safe_label', true);
        }

        return $menu;
    }

    /**
     * {@inheritdoc}
     */
    public function createRightMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $dropDownLabel = '<i class="icon-globe icon-white"></i> ' . $this->translator->trans('language.choice') . ' <b class="caret"></b>';
        $dropDown = $this->createDropdownMenuItem($menu, $dropDownLabel);
        $dropDown->setExtra('safe_label', true);

        foreach ($this->locales as $locale) {
            $icon = sprintf('<i class="icon-%s"></i>', $this->translator->getLocale() == $locale ? 'check' : '');
            $localeString = $icon . ' ' . $this->translator->trans(sprintf('locales.%s', $locale));

            $child = $dropDown->addChild($localeString, array(
                'route' => $request->attributes->get('_route'),
                'routeParameters' => array(
                    '_locale' => $locale,
                ),
            ));
            $child->setExtra('safe_label', true);
        }

        return $menu;
    }
}