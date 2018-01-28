<?php
namespace App\Repositories;
use Carbon\Carbon;
use App\Models\Document;

class ApproveRepository implements ApproveRepositoryInterface {
    protected $document;
    public function getParentPermissionDocument(){
        $this->document = new Document();
        return $this->document->document_type()->where('type_id','1')->get();
        
    }
    public function getTransactionDocument(){
        $this->document = new Document();
        return $this->document->document_type()->where('type_id','2')->get();
    }
}