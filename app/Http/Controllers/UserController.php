<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Auth\SignInResult;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class UserController extends Controller
{
    private $database;

    public function __construct(FirebaseService $database){
        $this->database = $database;
    }

    public function RegisterUser(Request $request){
        $userProperties = [
            'dsiplayName' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile_number' => $request->mob,
        ];
        $auth = $this->database->authConnect();
        $auth->createUser($userProperties);
    }

    public function login(Request $request){
        $email = $request->email;
        $clearTextPassword = $request->password;
        try {
            $user = $this->database->authConnect()->getUserByEmail($email);
            try{
                $signInResult = $this->database->authConnect()->signInWithEmailAndPassword($email, $clearTextPassword);
            }catch(Exception $e){
                throw new Exception('invalid credentials');
            }
            $idTokenString = $signInResult->idToken();
            try {
                $verifiedIdToken = $this->database->authConnect()->verifyIdToken($idTokenString);
                // $user = $this->database->authConnect()->getUser($uid);
                $uid = $verifiedIdToken->claims()->get('sub');
                // $ss = Session::put('uid',$uid);
                return response()->json([$signInResult->asTokenResponse()]);
            } catch (FailedToVerifyToken $e) {
                echo 'The token is invalid: '.$e->getMessage();
            }
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return 'invalid credentials';
        }
    }

    public function logout(Request $request){
      $token = $request->bearerToken();
      $verifiedIdToken = $this->database->authConnect()->verifyIdToken($token);
      $uid = $verifiedIdToken->claims()->get('sub');
      $this->database->authConnect()->revokeRefreshTokens($uid);
      try {
        $verifiedIdToken = $this->database->authConnect()->verifyIdToken($token, $checkIfRevoked = true);
        } catch (RevokedIdToken $e) {
        echo $e->getMessage();
      }
    }

    public function updateUser(Request $request){
        $uid = $this->getUserId($request);
        $details = $this->database->authConnect()->getUser($uid);
        $properties = $request->all();
        $updatedUser = $this->database->authConnect()->updateUser($uid, $properties);
        return 'success';
    }

    public function createEvent(Request $request){
        $uid = $this->getUserId($request);
        $data = [
            'name' => $request->name,
            'bill' => $request->amount,
            'user_id'=>$uid
        ];
        $this->database->connect()->getReference('/events')->push($data);
        return 'success';
    }

    public function getUserId(Request $request){
        $token = $request->bearerToken();
        $verifiedIdToken = $this->database->authConnect()->verifyIdToken($token);
        $uid = $verifiedIdToken->claims()->get('sub');
        return $uid;
    }

}
