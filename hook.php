<?php

/**
 * Plugin install process
 *
 * @return boolean
 */
function plugin_advtickets_install() {
    return true;
}

/**
 * Plugin uninstall process
 *
 * @return boolean
 */
function plugin_advtickets_uninstall() {
    return true;
}

/**
 * @param Ticket $ticket
 *
 * @return bool
 */
function plugin_advtickets_pre_item_add(Ticket $ticket)
{
    return PluginAdvticketsEvent::pre_item_add_ticket($ticket);
}