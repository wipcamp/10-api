<?php
namespace App\Repositories;
use Carbon\Carbon;
use App\Models\Profile;

class DashboardRepository implements DashboardRepositoryInterface {
    protected $carbon;
    protected $profile;
    public function getProfileRegistrantAmountInToday(){
        $this->profile = new Profile();
        $todayDate = new Carbon('now');
        $result = $this->profile->where('created_at','like','%'.$todayDate->toDateString().'%')->get()->count();
        return $result;
    }
    public function getCountdownCloseRegisterSystem(){
        
    }
}