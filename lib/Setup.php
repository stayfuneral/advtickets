<?php


namespace Adv;

/**
 * Class Setup
 *
 * @package Adv
 * @author Roman Gonyukov
 */

class Setup
{

    /**
     * @var array $hooksFunctions сущности, хуки и функции, их обрабатывающие
     */
    public static $hooksFunctions = [
        'Ticket' => [
            'item_add' => 'plugin_advtickets_item_add_ticket',
            'item_update' => 'plugin_advtickets_item_update_ticket'
        ]
    ];
}