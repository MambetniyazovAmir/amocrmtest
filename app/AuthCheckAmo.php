<?php

namespace App;

use AmoCRM\AmoAPI;
use AmoCRM\AmoAPIException;
use AmoCRM\TokenStorage\FileStorage;
use AmoCRM\TokenStorage\TokenStorageException;

trait AuthCheckAmo
{
    public function checkAuth()
    {
        try {
            AmoAPI::$tokenStorage = new FileStorage(public_path('/tokens'));
            $domain = AmoAPI::getAmoDomain(env('AMO_SUBDOMAIN'));
            $isFirstAuth = !AmoAPI::$tokenStorage->hasTokens($domain);
            if ($isFirstAuth) {
                AmoAPI::oAuth2(subdomain: env('AMO_SUBDOMAIN'), clientId: env('AMO_CLIENT_ID'), clientSecret: env('AMO_CLIENT_SECRET'), redirectUri: env('AMO_REDIRECT_URI'), authCode: 'def50200dd8c87f98fbebe295c666b0eefec6a2cfa1ac06ba21161b12304b2136df207fbbe41aa7a91c33cd1dbb3a5505041f115380b8489da215206861c9ba6025fd50f9838187e71dbe75a7593a61343db329df93ee04bcfc03c980e6b23f01374d6bcb529cc0790acb1030a37f878a8293e7b17222cc681f831ae9b950c83c731fbb1871da754a9216732326c3fc7659d46f53436ada2376addf1cca1101903f4e9666c5a1ea03548e1e512671040f0f766f93ac2b2256b07d5f0686083161a87284e170f42d5c0c9404906e0b2da3f4ceebd070bba7c7c0f4b3c8c94c8df0c074d5e6b3d7d67a0aff42c2d1f293b4b1c2f98edab6d93170579d23205631c30702b0746cd42be323169b5de3249cb4a007770bc5fd38675237178a4285f9fa1deba0787df7009b0e1b71df20e6f8100884899bb189c6eed93bcdb92920d0d42ecf2c43b7c2c23ce72249e83ff981b3e9b780e0954d6cf4e59dfba47deebd7ca194bbab04069a74f988c1be0d0293cc8bdf32d442657acff9ec5ce29a207f2ea5253d42381c668327640b7e6f8db3c5558de7d057165aacaff92a622b152c87fe83a4ed2124a92669e4fb81fa5558acff16c67df5f49e980b08b4db33c8b582be6880a55657d485c97b3927c072667c352b5ed5cb6085c5a961bfc71f01c3c23c2e9d2e86ca78b19');
            } else{
                AmoAPI::oAuth2(subdomain: env('AMO_SUBDOMAIN'));
            }
        } catch (AmoAPIException $e) {
            printf('Ошибка авторизации (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        } catch (TokenStorageException $e) {
            printf('Ошибка обработки токенов (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }
}
