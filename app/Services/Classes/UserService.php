<?php
namespace App\Services\Classes;

use App\Mail\PasswordVerificationCodeEmail;
use App\Repositories\Classes\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function findBy(Request $request){
        return $this->userRepository->findBy($request);
    }
    public function store($request){
        return $this->userRepository->store($request);
    }
    public function show($id)
    {
        return $this->userRepository->show($id);
    }

    public function find($id){
        return $this->userRepository->find($id);
    }

    public function update($request, $id)
    {
        if (!isset($request['password'])) {
            unset($request['password']);
        }
        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }
        $categories = $request['categories'];
        unset($request['categories']);
        $user =  $this->userRepository->update($request, $id);
        $user->categories()->sync($categories);
        return $user;
    }
    public function destroy($id)
    {
        $this->userRepository->destroy($id);
    }

    public function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('first_name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);

        try {
            $email = Mail::to('a.ahmedwageh@gmail.com')->send(new PasswordVerificationCodeEmail($token));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
