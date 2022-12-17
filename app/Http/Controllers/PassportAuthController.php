<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
       
        $token = $user->createToken('user')->accessToken;
 
        return response()->json([
            'name'=> $user->name,
            'email'=>$user->email,
            
            'token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email'=> 'required|email|exists:users',
            'password'=> 'required'
    ]);

    if($validate->fails())
    {
        return response()->json([
            'errors'=> $validate->errors()
        ], 422);
    } 
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $user = auth()->user();
            $Data['token_type'] = 'Bearer';
            $Data['access_token'] = auth()->user()->createToken('userToken')->accessToken;
           
            return response()->json([
                'name'=> $user->name,
                'email'=>$user->email,
                $Data], 200);
        } else {
            return response()->json(['error' => 'Email or Password incorrect'], 401);
        }
    }   
}