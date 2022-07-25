<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
         return [
            "status" => "OK",
            "results" => $users
            ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $member_id = $this->createMemberId($request);
            return [
                "status" => "OK",
                'results' => [
                    'member_id' => $member_id
                    ]
                ];
        } catch(Exception $e) {
            return $e;
            Log::error($e);
        }
    }

    /**
     * 会員番号の取得
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getMemberId(User $user, Request $request)
    {
        $user = User::where('line_user_id', $request->line_user_id)->first();
        if ($user) {
             $member_id = $user->member_id;
            return [
                'status' => 'ok',
                'results' => [
                    'member_id' => $member_id
                ]
            ];
        } else {
            $member_id = $this->createMemberId($request);
            return [
                'status' => 'ok',
                'results' => [
                    'member_id' => $member_id
                ]
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    private function createMemberId($request) {
        $member_id = uniqid();
        $line_user_id = $request->line_user_id;
        $name = '';
        $user = User::create([
            'member_id' => $member_id,
            'line_user_id' => $line_user_id,
            'name' => $name,
        ]);
        $user->save();
        return $member_id;
    }
}
