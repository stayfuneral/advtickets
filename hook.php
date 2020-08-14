<?php

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

/**
 * @param Ticket $item
 */
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
