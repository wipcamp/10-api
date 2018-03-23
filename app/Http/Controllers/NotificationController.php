<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NotificationRepositoryInterface;

class NotificationController extends Controller
{
    protected $notiRepo;

    public function __construct(NotificationRepositoryInterface $noti) {
        $this->notiRepo = $noti;
    }

    public function getAll() {
        $data = $this->notiRepo->getAll();
        return json_encode($data);
    }

    public function getByUserId($userId) {
        $data = $this->notiRepo->getByUserId($userId);
        return json_encode($data);
    }
}
