<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnnounceRepositoryInterface;

class AnnounceController extends Controller
{
    protected $announceRepo;

    public function __construct(AnnounceRepositoryInterface $announce) {
        $this->announceRepo = $announce;
    }

    public function getAll() {
        $data = $this->announceRepo->getAll();
        return json_encode($data);
    }

    public function getAnnounce($announceId) {
        $data = $this->announceRepo->getAnnounce($announceId);
        return json_encode($data);
    }
}
