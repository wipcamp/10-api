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
        return $this->profile->with('documents.document_type')->get();
    }
    public function updateDocApproveStatus($id,$status){
        $this->document  = new Document();
        return $this->document->where('id',$id)->update(['is_approve' => $status]);
    }
}