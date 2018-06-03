<?php

namespace Modules\Newsletter\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterNewsletterSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('newsletter::newsletters.title.newsletters'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('newsletter::subscribers.title.subscribers'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.newsletter.subscriber.create');
                    $item->route('admin.newsletter.subscriber.index');
                    $item->authorize(
                        $this->auth->hasAccess('newsletter.subscribers.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
