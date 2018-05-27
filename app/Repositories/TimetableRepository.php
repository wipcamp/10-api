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

    public function create($event, $description, $location, $start_on, $finish_on, $created_id, $role_team_id) {
        $timetable = new Timetable;

        $timetable->event = $event;
        $timetable->description = $description;
        $timetable->location = $location;
        $timetable->start_on = $start_on;
        $timetable->finish_on = $finish_on;
        $timetable->created_id = $created_id;
        $timetable->role_team_id = $role_team_id;

        $timetable->save();
        
        return "true";
    }

    public function update($timetableId, $event, $description, $location, $start_on, $finish_on, $created_id, $role_team_id) {
        $timetable = Timetable::find($timetableId);
        
        $timetable->event = $event;
        $timetable->description = $description;
        $timetable->location = $location;
        $timetable->start_on = $start_on;
        $timetable->finish_on = $finish_on;
        $timetable->created_id = $created_id;
        $timetable->role_team_id = $role_team_id;

        $timetable->save();
        
        return "true";
        
    }

    public function delete($timetableId) {
        $timetable = Timetable::find($timetableId);

        $timetable->delete();

        return "true";
    }
}