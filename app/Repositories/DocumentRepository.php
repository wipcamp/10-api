<?php
namespace App\Repositories;

use App\Models\Document;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\DocumentFormatRepository;

class DocumentRepository implements DocumentRepositoryInterface {

  public function create($userData) {
    $document = new DocumentTypeRepository;
    $documentFormat = new DocumentFormatRepository;
    return Document::create([
        'user_id' => $userData['userId'],
        'type_id' => $document->getIdByName($userData['fileType']),
        'format_id' => $documentFormat->getIdByName($userData['documentFormat']),
        'path' => $userData['path']
    ]);
  }

  public function update() {
    $document = new DocumentTypeRepository;
    $documentFormat = new DocumentFormatRepository;
    return Document::where([
      'user_id' => $userData['userId'],
      'type_id' => $document->getIdByName($userData['fileType'])
      ])->update([
        'format_id' => $documentFormat->getIdByName($userData['documentFormat']),
        'path' => $userData['path']
    ]);
  }

}