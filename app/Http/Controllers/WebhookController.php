<?php

namespace App\Http\Controllers;

use AmoCRM\AmoAPIException;
use AmoCRM\AmoNote;
use AmoCRM\AmoObject;
use App\AuthCheckAmo;
use Illuminate\Http\Request;


class WebhookController extends Controller
{
    use AuthCheckAmo;

    private mixed $domain = 'mramirniyaz';

    public function leadAdded(Request $request): void
    {
        /*
         * add name,contactName,created_at,responsible_user_id note to the lead when gets webhook
         */
        $this->checkAuth();
        try {
            $note = new AmoNote([
                'element_id' => $request->leads['add'][0]['id'],
                'note_type' => AmoNote::COMMON_NOTETYPE,
                'element_type' => AmoObject::LEAD_TYPE,
                'text' => 'NAME: ' . $request->leads['add'][0]['name'] . "\n" . 'CREATED_AT: ' . $request->leads['add'][0]['created_at'] . "\n" . 'RESPONSIBLE_USER_ID: ' . $request->leads['add'][0]['responsible_user_id']
            ]);
            $note->save();
        } catch (AmoAPIException $e) {
            printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }

    public function leadEdited(Request $request)
    {
        /*
         * add note edited columns with its values
         */
        $this->checkAuth();
        try {
            $note = new AmoNote([
                'element_id' => $request->leads['update'][0]['id'],
                'note_type' => AmoNote::COMMON_NOTETYPE,
                'element_type' => AmoObject::LEAD_TYPE,
                'text' => 'NAME: ' . $request->leads['update'][0]['name'] . "\n" . 'CREATED_AT: ' . $request->leads['update'][0]['created_at'] . "\n" . 'RESPONSIBLE_USER_ID: ' . $request->leads['update'][0]['responsible_user_id']
            ]);
            $note->save();
        } catch (AmoAPIException $e) {
            printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }

    public function contactAdded(Request $request): void
    {
        $this->checkAuth();
        try {
            $note = new AmoNote([
                'element_id' => $request->contacts['add'][0]['id'],
                'note_type' => AmoNote::COMMON_NOTETYPE,
                'element_type' => AmoObject::CONTACT_TYPE,
                'text' => 'NAME: ' . $request->contacts['add'][0]['name'] . "\n" . 'CREATED_AT: ' . $request->contacts['add'][0]['created_at'] . "\n" . 'RESPONSIBLE_USER_ID: ' . $request->contacts['add'][0]['responsible_user_id']
            ]);
            $note->save();
        } catch (AmoAPIException $e) {
            printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }

    public function contactEdited(Request $request)
    {
        $this->checkAuth();
        try {
            $note = new AmoNote([
                'element_id' => $request->contacts['update'][0]['id'],
                'note_type' => AmoNote::COMMON_NOTETYPE,
                'element_type' => AmoObject::CONTACT_TYPE,
                'text' => 'NAME: ' . $request->contacts['update'][0]['name'] . "\n" . 'CREATED_AT: ' . $request->contacts['update'][0]['created_at'] . "\n" . 'RESPONSIBLE_USER_ID: ' . $request->contacts['update'][0]['responsible_user_id']
            ]);
            $note->save();
        } catch (AmoAPIException $e) {
            printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }
}
