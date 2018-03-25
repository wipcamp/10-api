<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Profile;
use App\Models\Camp;

class DashboardRepository implements DashboardRepositoryInterface {
    protected $carbon;
    protected $profile;
    protected $camp;
    public function getProfileRegistrantAmountInToday(){
        $this->profile = new Profile();
        $todayDate = new Carbon('now');
        $result = $this->profile->where('created_at','like','%'.$todayDate->toDateString().'%')->get()->count();
        return $result;
    }
    public function getCampDetail(){
        $this->camp = new Camp();
        $result = $this->camp->where('season',10)->get();
        return $result[0];
    }
    public function getCountTranscript (){
        return DB::select(
            '
            SELECT COUNT(*) as sum FROM `documents` WHERE type_id = 2
            '
        );
    }
    public function getCountParentAccept (){
        return DB::select(
            '
            SELECT COUNT(*) as sum FROM `documents` WHERE type_id = 3
            '
        );
    }
    public function getAllSuccessRegister () {
        return DB::select(
            '
            SELECT * FROM `profiles` as p JOIN `profile_registrants` as pr ON pr.user_id = p.user_id WHERE pr.known_via is NOT NULL && pr.activities is NOT NULL && pr.skill_computer is NOT NULL && pr.activities is NOT NULL && p.user_id in (SELECT user_id FROM `eval_answers` GROUP BY user_id HAVING COUNT(*) = 6) && p.user_id in (SELECT user_id FROM `documents` WHERE type_id = 2 && user_id in (SELECT user_id FROM `documents` WHERE type_id = 3))
            '
        );
    }
    public function getAllRegister () {
        return DB::select(
            '
            SELECT count(*) as sum FROM `profiles`
            '
        );
    }
    public function getAllUserDocSuccess () {
        return DB::select(
            '
            SELECT COUNT(user_id) as sum FROM `documents` WHERE type_id = 2 && user_id in (SELECT user_id FROM `documents` WHERE type_id = 3)
            '
        );
    }
    public function getAllProfileSuccess () {
        return DB::select(
            '
            SELECT COUNT(*) as sum FROM `profile_registrants` as pr JOIN `profiles` as p ON pr.user_id = p.user_id WHERE pr.known_via is NOT NULL && pr.activities is NOT NULL && pr.skill_computer is NOT NULL && pr.activities is NOT NULL
            '
        );
    }
}