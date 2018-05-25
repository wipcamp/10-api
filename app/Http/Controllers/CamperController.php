<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\CamperRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class CamperController extends Controller
{
    function __construct() {
        $this->camper = new CamperRepository;
    }

    public function getCamperByUserId($userId) {
        $camper = $this->camper->getCamperByUserId($userId);
        if ($camper) {
            return response()->json([
                'status' => 200,
                'data' => $camper
            ]);
        }
        return response()->json([
            'status' => 200,
            'data' => false
        ]);
    }
    
    public function getAllCampers() {
        return response()->json([
            'status' => 200,
            'data' => $this->camper->getAllCampers()
        ]);
    }

    public function getCamperByPersonId($personId) {
        $camper = $this->camper->getCamperByPersonId($personId);
        if ($camper) {
            return response()->json([
                'status' => 200,
                'data' => $camper
            ]);
        }
        return response()->json([
            'status' => 200,
            'data' => false
        ]);
    }

    public function updateFlavor(Request $request, $userId) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'sectionId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        $result;
        try {
            $result = $this->camper->updateFlavor($userId, $data['sectionId']);
        } catch (QueryException $e) {
            $result = $e;
        }
        
        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }
    
    public function updateCheckin(Request $request, $userId) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'checkedAt' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        $checkedServer = Carbon::now();
        $checkedClient = Carbon::parse($data['checkedAt']);

        $checkedServer->second = 0;
        $checkedClient->second = 0;
        
        $checkedServer = $checkedServer->toDateTimeString();
        $checkedClient = $checkedClient->toDateTimeString();
        
        $result;

        if ($checkedClient == $checkedServer) {
            $URL = env('SMS_URL');
            $METHOD = env('SMS_POST');
            $USERNAME = env('SMS_USERNAME');
            $SENDER = env('SMS_SENDER');
            $PASSWORD = env('SMS_PASSWORD');

            try {
                $this->camper->updateCheckin($userId, Carbon::now());

                $camper = $this->camper->getCamperByUserId($userId)[0];
                $nickname = $camper->profile->nickname;
                $telnoParent = $camper->profile_registrant->telno_parent;
        
                $messageCheckin = urlencode("น้อง${nickname} ได้เดินทางมาถึงค่ายและได้อยู่ในความดูแลของพี่ค่าย WIP Camp#10 แล้วครับ สามารถติดต่อได้ที่เบอร์ 02-107-3576");
                
                $POST_SMS = $URL.$METHOD.'?'."User=${USERNAME}"."&Password=${PASSWORD}"."&Msnlist=${telnoParent}"."&Msg=${messageCheckin}"."&Sender=${SENDER}";
                try {
                    $client = new \GuzzleHttp\Client;
                    $result = (string) $client->get($POST_SMS)->getBody(true);
                } catch (\Exception $e) {
                    $result = 'Exception at SMS';
                }
            } catch (QueryException $e) {
                $result = $e;
            }
        } else {
            $result = false;
        }
        
        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }

    public function getAcceptDocs(Request $request, $userId) {
        try {
            $acceptDocs = Storage::get('public/accept_docs/ID-'.$userId.'.pdf');
            return response($acceptDocs)->header('Content-Type', 'application/pdf');
        } catch (Exception $e) {
            return resonse()->json([
                'status' => 200,
                'message' => 'Error in get document process.'
            ]);
        }
    }
}
