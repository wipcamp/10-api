<?php
namespace App\Repositories;

use App\Models\Document;
use App\Models\ProfileCamper;


class SlipRepository implements SlipRepositoryInterface {

    protected  $document;
    protected  $camper;
    /**
     * DATAEXAMPLE
     *  documents:{
            "id": 30,
            "user_id": 100017,
            "type_id": 1,
            "format_id": 1,
            "path": "https://scontent.xx.fbcdn.net/...,
            "issued_at": null,
            "is_approve": null,
            "approve_reason": null,
            "created_at": "2018-02-11 17:50:38",
            "updated_at": "2018-02-11 17:50:38"
        },
     */

    public function __construct()
    {
        $this->camper = new ProfileCamper;
        $this->document = new Document;
    }

    public function allCampers() 
    {
        return $this->camper->with('profile','profile.documents')->get(); //getAllItims from Profile_camper 
    }

    public function getCamperWithDoc($id)
    {
        return $this->document->with('profile')->where('id',$id)->first();//**CHECK ORDER! */
    }

    public function putDocument($id,$status)
    {
        return $this->document->where('id',$id)->update(['is_approve'=>$status]); //
    }
}