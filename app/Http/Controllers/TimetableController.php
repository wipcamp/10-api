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

    public function getByDate($date) {
        $data = $this->timetableRepo->getByDate($date);
        return json_encode($data);
    }

    public function create(Request $request) {
        $data = $request->all();

        $event = array_get($data, 'event');
        $description = array_get($data, 'description');
        $location = array_get($data, 'location');
        $start_on = array_get($data, 'start_on');
        $finish_on = array_get($data, 'finish_on');
        $created_id = array_get($data, 'created_id');
        $role_team_id = array_get($data, 'role_team_id');
        
        $result = 'false';

        if(!is_null($event) && !is_null($description) && 
            !is_null($location) && !is_null($start_on) &&
            !is_null($finish_on) && !is_null($created_id) &&
            !is_null($role_team_id)) {
            $result = $this->timetableRepo->create($event, $description, $location, $start_on, $finish_on, $created_id, $role_team_id);
        }

        return json_encode($result);
    }

    public function update($timetableId, Request $request) {
        $data = $request->all();

        $event = array_get($data, 'event');
        $description = array_get($data, 'description');
        $location = array_get($data, 'location');
        $start_on = array_get($data, 'start_on');
        $finish_on = array_get($data, 'finish_on');
        $created_id = array_get($data, 'created_id');
        $role_team_id = array_get($data, 'role_team_id');
        
        $result = 'false';

        if(!is_null($event) && !is_null($description) && 
            !is_null($location) && !is_null($start_on) &&
            !is_null($finish_on) && !is_null($created_id) &&
            !is_null($role_team_id)) {
            $result = $this->timetableRepo->update($timetableId, $event, $description, $location, $start_on, $finish_on, $created_id, $role_team_id);
        }

        return json_encode($result);
    }

    public function delete($timetableId) {
        $result = $this->timetableRepo->delete($timetableId);
        return $result;
    }
}
