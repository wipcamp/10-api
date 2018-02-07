<?php
namespace App\Repositories;
use Carbon\Carbon;
use App\Models\Document;
use App\Models\Profile;

class ApproveRepository implements ApproveRepositoryInterface {
    protected $document;
    protected $profile;

    public function getParentPermissionDocument(){
        $this->document = new Document();
        return $this->document->where('type_id', '1')->get();
        
    }
    public function getTransactionDocument(){
        $this->document = new Document();
        return $this->document->where('type_id','2')->get();
    }
    public function getAllItimsWithDoc(){
        $this->profile = new Profile();
        // $data = collect($this->profile->with('documents.document_type')->get());
        //    $data = $data->map(function($value, $key){
        //     $value = $value->documents->filter(function ($doc,$docKey){
        //         return $doc->type_id > 1 ;
        //     });
        //         return $value;
        //     });
        // return $data;
        return $this->profile->with('documents.document_type')->get();
    }
}