<?php
namespace App\Repositories;

use App\Models\Timetable;

class TimetableRepository implements TimetableRepositoryInterface {

    public function getAll() {
        $data = Timetable::all();
        return $data;
    }

    public function getTimetable($timetableId) {
        $data = Timetable::find($timetableId);
        return $data;
    }

    public function getByRoleTeamId($roleTeamId) {
        $data = Timetable::where('role_team_id', $roleTeamId)->get();
        return $data;
    }

    public function getByDate($date) {
        $data = Timetable::whereDate('start_on', $date)->get();
        return $data;
    }

}