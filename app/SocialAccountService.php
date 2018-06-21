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
                $uemail = $providerUser->getEmail();
                if(empty(trim($uemail))){
                  $uemail = $providerUser->getId();
                }

                $user = User::create([
                            'username' => str_replace(' ','_',str_replace('.','_',str_replace('@','_',$providerUser->getName()))).rand(11111, 99999),
                            'email' => $uemail,
                            'name' => $providerUser->getName(),
                            'user_image' => $providerUser->getAvatar(),
                            'password' => $providerName,
                ]);                              
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

}
