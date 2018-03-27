<?php

namespace App\Repositories;

use App\Models\Notification;
use \ExponentPhpSDK\Expo;

class NotificationRepository implements NotificationRepositoryInterface {

    public function createNotification(int $wipId, string $expoToken, string $title, string $body, string $tableName, int $tableNameId) {
        $expo = Expo::normalSetup();
        $expo->subscribe("WIPX" . $wipId . "Dev", $expoToken);
        
        $notification = [
            'title' => $title,
            'body' => $body,
            'data' => json_encode([
                "table" => $tableName,
                "id" => $tableNameId
            ])
        ];

        $expo->notify("WIPX" . $wipId . "Dev", $notification);

        $noti = new Notification;

        $noti->user_id = $wipId;
        $noti->title = $title;
        $noti->body = $body;
        $noti->data = json_encode([
            "table" => $tableName,
            "id" => $tableNameId
        ]);

        $noti->save();
        
        return "true";
    }
    
    public function getAll() {
        $data = Notification::all();
        return $data;        
    }

    public function getByUserId($userId) {
        $data = Notification::where('user_id', $userId)->get();
        return $data;
    }
}