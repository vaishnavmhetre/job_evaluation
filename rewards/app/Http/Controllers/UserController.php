<?php

namespace App\Http\Controllers;

use App\Events\NewlyRegistered;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function register(Request $request)
    {

        /**
         * Check if valid input received from user to create user
         */

        $userCreationValidator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email'
        ]);

        if ($userCreationValidator->fails()) {
            // Respond with errors if validation failed with 400 BAD REQUEST status
            return response()->json($userCreationValidator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => app('hash')->make($request->password)
        ]);

        /**
         * Dispatch event of newly registered user
         *
         * You can ignore reward for NewlyRegistered to have a random reward.
         * You can pass name of reward to get a random reward if you have multiple rewards with same name
         * You can pass reward object to directly assign the same reward to the user
         */

        event(new NewlyRegistered($user, 'registration'));


        // Return user instance with 201 CREATED status
        return response()->json($user, Response::HTTP_CREATED);
    }

    public function userRewards(Request $request, $id)
    {
        // Find the user using ID
        $user = User::findOrFail($id);

        // Return the received Rewards for given User
        return response()->json($user->receivedRewards);
    }
}
