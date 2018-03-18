<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TimetableRepositoryInterface;

class TimetableController extends Controller
{
    protected $timetableRepo;

    public function __construct(TimetableRepositoryInterface $timetable) {
        $this->timetableRepo = $timetable;
    }

    public function getAll() {
        $data = $this->timetableRepo->getAll();
        return json_encode($data);
    }

    public function getTimetable($timetableId) {
        $data = $this->timetableRepo->getTimetable($timetableId);
        return json_encode($data);
    }

    public function getByRoleTeamId($roleTeamId) {
        $data = $this->timetableRepo->getByRoleTeamId($roleTeamId);
        return json_encode($data);
    }
}
