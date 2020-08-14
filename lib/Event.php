<?php


namespace Adv;

/**
 * Class Event
 *
 * Отвечает за обработку хуков glpi.
 *
 * @author Roman Gonyukov
 * @package Adv
 */

class Event
{

    /**
     * @var string PLUGIN_ADVTICKETS_DB_TABLE_EVENTS название таблицы, куда записываются данные при срабатывании хуков
     */
    const PLUGIN_ADVTICKETS_DB_TABLE_EVENTS = 'glpi_plugin_advtickets_events';

    private static $instance = null;
    private $db;

    /**
     * Event constructor.
     *
     * @global \DB $DB
     */
    private function __construct($DB)
    {
        $this->db = $DB;
    }

    /**
     * @global $DB
     *
     * @return Event|null
     */
    public static function getInstance()
    {
        global $DB;
        if(self::$instance === null) {
            self::$instance = new self($DB);
        }

        return self::$instance;
    }


    /**
     * Обработчик хука item_add.
     *
     * Срабатывает при создании новой заявки.
     *
     * Добавляет запись в таблицу glpi_plugin_advtickets_events.
     *
     * @param \Ticket $ticket
     */
    public function handleNewTicket(\Ticket $ticket)
    {
        $ticketId = $ticket->getID();
        $eventParams = $this->prepareParams('Ticket', $ticketId, 'item_add');
        $this->db->insert(self::PLUGIN_ADVTICKETS_DB_TABLE_EVENTS, $eventParams);
    }

    /**
     * Обработчик хука item_update.
     *
     * Срабатывает при создании новой заявки.
     *
     * Добавляет запись в таблицу glpi_plugin_advtickets_events.
     *
     * @param \Ticket $ticket
     */
    public function handleUpdatedTicket(\Ticket $ticket)
    {
        $ticketId = $ticket->getID();
        $eventParams = $this->prepareParams('Ticket', $ticketId, 'item_update');
        $this->db->insert(self::PLUGIN_ADVTICKETS_DB_TABLE_EVENTS, $eventParams);
    }

    /**
     * Подготавливает массив для записи в таблицу событий
     *
     * @param string $itemType тип сущности
     * @param integer $itemId id сущности
     * @param string $eventType тип события
     *
     * @return array
     */
    private function prepareParams($itemType, $itemId, $eventType)
    {
        return [
            'item_type' => $itemType,
            'item_id' => $itemId,
            'event_type' => $eventType
        ];
    }


}