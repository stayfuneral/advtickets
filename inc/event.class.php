<?php


class PluginAdvticketsEvent extends CommonDBTM
{
    static function pre_item_add_ticket(Ticket $ticket)
    {
        global $DB;

        $fields = $ticket->input;

        if(isset($fields['_linkedto'])) {

            $relatedTicketId = $fields['_linkedto'];

            $relatedTicketParamsForUpdate = [
                'itemtype' => \Ticket::class,
                'items_id' => $relatedTicketId,
                'users_id' => $fields['_users_id_requester'],
                'users_id_editor' => 0,
                'content' => $fields['content'],
                'date' => date('c'),
                'date_mod' => date('c'),
                'date_creation' => date('c'),
                'is_private' => 0,
                'requesttypes_id' => $fields['requesttypes_id'],
                'timeline_position' => 4,
                'sourceitems_id' => 0,
                'sourceof_items_id' => 0
            ];

            $DB->insert('glpi_itilfollowups', $relatedTicketParamsForUpdate);

            $DB->update('glpi_tickets', [
                'status' => 1
            ], [
                'id' => $relatedTicketId
            ]);

            $ticket->input = false;

            return $ticket->input;
        }
    }
}