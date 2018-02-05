<?php
namespace App\Repositories;

use App\Models\DocumentFormat;

class DocumentFormatRepository implements DocumentFormatRepositoryInterface {

  public function getIdByName($formatName) {
    return DocumentFormat::where('mime_type',  $formatName)->first()->id;
  }

}