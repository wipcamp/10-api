<?php
namespace App\Repositories;

use App\Models\Announce;

class AnnounceRepository implements AnnounceRepositoryInterface {

    public function getAll() {
        $data = Announce::all();
        return $data;
    }

    public function getAnnounce($announceId) {
        $data = Announce::find($announceId);
        return $data;
    }
}