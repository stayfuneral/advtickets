<?php


namespace Adv;

/**
 * Class Database
 *
 * Устанавливает и удаляет таблицы плагина в БД
 *
 * @package Adv
 * @author Roman Gonyukov
 */

class Database
{
    const PLUGIN_ADVTICKETS_DB_TABLE_PREFIX = 'glpi_plugin_advtickets_';
    const FIELD_PRIMARY_KEY = 'primary key (id)';

    public static $tables = [
        'events' => [
            'id int(11) not null auto_increment',
            'item_type varchar(100) not null',
            'item_id int(11) not null',
            'event_type varchar(50) not null',
            'event_date datetime default current_timestamp',
            self::FIELD_PRIMARY_KEY
        ]
    ];

    /**
     * Создаёт таблицы в БД при установке плагина
     *
     * @global \DB $DB
     */
    public static function installDbTables()
    {
        global $DB;

        foreach (self::$tables as $table => $fields) {

            $tableName = self::PLUGIN_ADVTICKETS_DB_TABLE_PREFIX . $table;

            if(!$DB->tableExists($tableName)) {
                $sql = "create table $tableName (" . implode(', ', $fields) . ")";
                $DB->queryOrDie($sql, $DB->error());
            }

        }
    }

    /**
     * Удаляет таблицы из БД при удалении плагина
     *
     * @global \DB $DB
     */
    public static function uninstallDbTables()
    {
        global $DB;

        foreach (self::$tables as $table => $fields) {

            $tableName = self::PLUGIN_ADVTICKETS_DB_TABLE_PREFIX . $table;

            if($DB->tableExists($tableName)) {
                $sql = "drop table $tableName";
                $DB->queryOrDie($sql, $DB->error());
            }

        }
    }
}