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

  public function getUserProviderByCredentials($facebookId, $accessToken) {
    $user = new ProviderUser;
    return $user
        ->where([
            'provider_acc' => $facebookId,
            'access_token' => $accessToken
            ])
        ->first();
  }

  
  public function getByProviderAcc($providerAcc) {
    return ProviderUser::where('provider_acc', $providerAcc)->first();
  }
}