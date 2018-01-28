<?php
namespace App\Repositories;
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
}