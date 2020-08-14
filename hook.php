<?php
/*
 -------------------------------------------------------------------------
 AdvTickets plugin for GLPI
 Copyright (C) 2020 by the AdvTickets Development Team.

 https://github.com/pluginsGLPI/advtickets
 -------------------------------------------------------------------------

 LICENSE

 This file is part of AdvTickets.

 AdvTickets is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 AdvTickets is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with AdvTickets. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

/**
 * Plugin install process
 *
 * @return boolean
 */
function plugin_advtickets_install() {
   plugin_advticket_autoload_classes();
   Adv\Database::installDbTables();
   return true;
}

/**
 * Plugin uninstall process
 *
 * @return boolean
 */
function plugin_advtickets_uninstall() {
    plugin_advticket_autoload_classes();
    Adv\Database::uninstallDbTables();
    return true;
}

/**
 * @param Ticket $item
 */
function plugin_advtickets_item_add_ticket(Ticket $item) {
    plugin_advticket_autoload_classes();

    Adv\Event::getInstance()->handleNewTicket($item);
}

function plugin_advtickets_item_update_ticket(Ticket $item)
{
    plugin_advticket_autoload_classes();

    Adv\Event::getInstance()->handleUpdatedTicket($item);

    Session::addMessageAfterRedirect('Updated ticket:' . $item->getID());
}

/**
 * Вызывает автозагрузчик composer
 */
function plugin_advticket_autoload_classes()
{
    require __DIR__ . '/vendor/autoload.php';
}
