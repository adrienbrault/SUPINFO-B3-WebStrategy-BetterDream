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
     * @param FactoryInterface    $factory
     * @param TranslatorInterface $translator
     */
    public function __construct(FactoryInterface $factory, TranslatorInterface $translator)
    {
        parent::__construct($factory);

        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setCurrentUri($request->getRequestUri());
        $menu->setChildrenAttribute('class', 'nav');

        $menu->addChild($this->translator->trans('titles.home'), array('route' => 'betterdream_web_main_index'));
        $menu->addChild($this->translator->trans('titles.help'), array('route' => 'betterdream_web_main_help'));
        $menu->addChild($this->translator->trans('titles.contact'), array('route' => 'betterdream_web_main_contact'));
        $menu->addChild($this->translator->trans('titles.about'), array('route' => 'betterdream_web_main_about'));

        return $menu;
    }
}