<?php

namespace Modules\Gallery\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterGallerySidebar extends AbstractAdminSidebar
{
    /**
     * Method used to define your sidebar menu groups and items
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('gallery::galleries.galleries'), function (Item $item) {
                $item->icon('fa fa-image');
                $item->weight(0);
                $item->route('admin.gallery.galleries.index');
                $item->authorize(
                    $this->auth->hasAccess('gallery.galleries.index')
                );
            });
        });

        return $menu;
    }
}
