<?php

namespace App;

use Laravel\Socialite\Contracts\Provider;

class SocialAccountService {

    public function createOrGetUser(Provider $provider) {

        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = SocialAccount::whereProvider($providerName)
                ->whereProviderUserId($providerUser->getId())
                ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getNickname())->first();

            if (!$user) {

                $user = User::create([
                            'username' => str_replace('.','_',str_replace('@','_',$providerUser->getName())),
                            'email' => $providerUser->getEmail(),
                            'name' => $providerUser->getName(),
                            'user_image' => $providerUser->getAvatar(),
                            'password' => $providerName,
                ]);

                if ($providerUser->hasFile('user_image')) {
                    $uploadPath = public_path('/uploads/avatar/');

                    $extension = 'jpg';
                    $fileName = rand(11111, 99999) . '.' . $extension;

                    $file = $request->file('user_image');
                    Image::make($file->getRealPath())->fit(240, 240)->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();

                    //$request->file('buqu_image')->move($uploadPath, $fileName);
                    $requestData['user_image'] = $fileName;
                }
            }else{
              $user = User::create([
                          'username' => str_replace('.','_',str_replace('@','_',$providerUser->getName())).rand(11111, 99999),                   
                          'email' => $providerUser->getEmail(),
                          'name' => $providerUser->getName(),
                          'user_image' => $providerUser->getAvatar(),
                          'password' => $providerName,
              ]);

              if ($providerUser->hasFile('user_image')) {
                  $uploadPath = public_path('/uploads/avatar/');

                  $extension = 'jpg';
                  $fileName = rand(11111, 99999) . '.' . $extension;

                  $file = $request->file('user_image');
                  Image::make($file->getRealPath())->fit(240, 240)->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();

                  //$request->file('buqu_image')->move($uploadPath, $fileName);
                  $requestData['user_image'] = $fileName;
              }
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

}
