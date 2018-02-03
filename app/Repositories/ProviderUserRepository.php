<?php
namespace App\Repositories;

use App\Models\ProviderUser;

use App\Repositories\ProviderRepository;

class ProviderUserRepository implements ProviderUserRepositoryInterface {

  public function create($userData) {
    $provider = new ProviderRepository;
    return ProviderUser::create([
        'user_id' => $userData['userId'],
        'account_name' => $userData['accountName'],
        'provider_id' => $provider->getIdByName($userData['providerName']),
        'provider_acc' => $userData['providerAcc'],
        'access_token' => $userData['accessToken'],
        'expired_in' => $userData['expiredIn']
    ]);
  }

}