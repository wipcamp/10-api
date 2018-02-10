<?php
namespace App\Repositories;

use App\Models\DocumentType;

class DocumentTypeRepository implements DocumentTypeRepositoryInterface {

  public function getIdByName($typeName) {
    return DocumentType::where('name',  $typeName)->first()->id;
  }

}