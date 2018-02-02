<?php
namespace App\Repositories;
use App\User;
use App\Models\Provider;
use App\Models\ProviderUser;
use App\Models\Document;
use App\Models\DocumentFormat;
use App\Models\DocumentType;
use App\Models\Role;
use App\Models\UserRole;


class UserRepository implements UserRepositoryInterface {
  public function create($data) {
    // constant
    $roleName = 'reg_registrants';
    $providerName = 'facebook';
    // create
    $user = User::create();
    $userRole = UserRole::create([
        'user_id' => $user->id,
        'role_id' => Role::where('name',  $roleName)->first()->id
    ]);
    $providerUser = ProviderUser::create([
        'user_id' => $user->id,
        'account_name' => $data['name'],
        'provider_id' => Provider::where('name', $providerName)->first()->id,
        'provider_acc' => $data['id'],
        'access_token' => $data['accessToken'],
        'expired_in' => $data['expiresIn']
    ]);
    $document = Document::create([
        'user_id' => $user->id,
        'type_id' => DocumentType::where('name', 'image')->first()->id,
        'format_id' => DocumentFormat::where('name', 'jpg')->first()->id,
        'path' => $data['id']['data']['url']
    ]);


    return json_encode(['result' =>
        [
            'user' => $user,
            'providerUser' => $providerUser,
            'document' => $document
        ]
    ]);
  }

  public function get() {
    return User::get();
  }
}