<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * メンバー作成.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request) {
        $member = Member::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'tel' => $request->tel,
        ]);

        return response()->json($member);
    }

    /**
     * メンバー取得.
     *
     * @param Request $request
     * @return void
     */
    public function fetch(Request $request) {
        $member = Member::find($request->member_id);
        return response()->json($member);
    }

    /**
     * メンバー更新.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request) {
        $member = Member::find($request->member_id);
        $member->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'tel' => $request->tel,
        ]);

        return response()->json($member);
    }

    /**
     * メンバー削除.
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request) {
        $member = Member::find($request->member_id);
        $member->delete();
        return response()->json();
    }
}