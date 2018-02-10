<?php
namespace App\Repositories;

use App\Models\Provider;

class ProviderRepository implements ProviderRepositoryInterface {

  public function getIdByName($providerName) {
    return Provider::where('name', $providerName)->first()->id;
  }

}