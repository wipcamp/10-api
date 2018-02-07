<?php
namespace App\Repositories;

use App\User;

use App\Repositories\UserRoleRepository;
use App\Repositories\ProviderUserRepository;
use App\Repositories\DocumentRepository;


class UserRepository implements UserRepositoryInterface {

  public function create($data) {
    // constant
    $roleName = 'reg_registrants';
    $providerName = 'facebook';
    $fileType = 'profile_picture';
    $imageUrl = $data['picture']['data']['url'];
    $imageType = image_type_to_mime_type(exif_imagetype($imageUrl));
    // create
    $provider = new ProviderRepository;
    // user
    $user = User::create([
        'account_name' => $data['name'],
        'provider_id' => $provider->getIdByName($providerName),
        'provider_acc' => $data['id'],
        'access_token' => $data['accessToken'],
        'expired_in' => $data['expiresIn']
        ]);
    // user role
    $userRole = new UserRoleRepository;
    $userRole->create($user->id, $roleName);
    // document
    $document = new DocumentRepository;
    $document = $document->create([
        'userId' => $user->id,
        'fileType' => $fileType,
        'imageType' => $imageType,
        'path' => $imageUrl
    ]);

    return json_encode(['result' =>
        [
            'user' => $user,
            'document' => $document
        ]
    ]);
  }

  public function getUserProviderByCredentials($facebookId) {
    $user = new User;
    return $user
        ->where([
            'provider_acc' => $facebookId
            ])
        ->first();
  }
  
  public function getByProviderAcc($providerAcc) {
    return User::where('provider_acc', $providerAcc)->first();
  }
}