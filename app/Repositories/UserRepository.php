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
    // user
    $user = User::create();
    // user role
    $userRole = new UserRoleRepository;
    $userRole->create($user->id, $roleName);
    // provider user
    $providerUser = new ProviderUserRepository;
    $providerUser = $providerUser->create([
        'userId' => $user->id,
        'accountName' => $data['name'],
        'providerName' => $providerName,
        'providerAcc' => $data['id'],
        'accessToken' => $data['accessToken'],
        'expiredIn' => $data['expiresIn']
    ]);
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
            'providerUser' => $providerUser,
            'document' => $document
        ]
    ]);
  }
}