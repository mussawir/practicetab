<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class AffiliateController extends Controller
{
	var $member_info = null;
	public function __construct()
	{
		$this->member_info = Affiliate::where('user_id', '=', Auth::user()->user_id)->first();
	}

	public function index()
	{
		$list = Affiliate::where('created_by', '=', $this->member_info->id)->get();
		return view('member.affiliate.index')->with('list', $list)
			->with('page_title', 'Affiliate List')
			->with('afi_main_menu', 'active')
			->with('afi_list_menu', 'active');
	}

	public function create()
	{
		$list = Session::has('afi_data') ? Session::get('afi_data') : array();

		return view('member.affiliate.new')->with('my_info', $this->member_info)
			->with('list', $list)
			->with('afi_main_menu', 'active')
			->with('afi_new_menu', 'active');
	}

	public function createList(Request $request)
	{
		$session_data = Session::has('afi_data') ? Session::get('afi_data') : array();
		foreach ($session_data as $data) {
			if ($data['email'] == $request['email']) {
				Session::put('error', 'Affiliate already added');
				return Redirect::Back();
			}
		}

		Session::push('afi_data', array(
			'first_name'=>$request['first_name'],
			'last_name'=>$request['last_name'],
			'phone'=>$request['phone'],
			'email'=>$request['email']
		));

		return Redirect::Back();
	}

	public function removeAddedMember()
	{
		$data = Session::get('afi_data');
		foreach ($data as $index => $val) {
			if ($val['email'] == Input::get('email')) {
				unset($data[$index]);
			}
		}

		Session::put('afi_data', $data);
		echo 'success';
	}

	public function store(Request $request)
	{
		$inputs = $request->all();

		for ($i = 0; $i < count($inputs['first_name']); $i++)
		{
			/*$password = Str::quickRandom(8);
			$user = User::create([
				'role' => 5,
				'first_name' => $inputs['first_name'][$i],
				'last_name' => $inputs['last_name'][$i],
				'email' => $inputs['email'][$i],
				'password' => bcrypt($password)
			]);*/

			$member = Affiliate::create([
				'first_name' => $inputs['first_name'][$i],
				'last_name' => $inputs['last_name'][$i],
				'email' => $inputs['email'][$i],
				'phone' => $inputs['phone'][$i],
				'message' => $inputs['message'],
				//'user_id' => $user->user_id,
				'created_by' => $this->member_info->id,
				'affiliate_type' => 2
			]);

			\Mail::queue([], [], function ($message) use ($member) {

				$message->from('noreply@practicetabs.com', 'practicetabs.com');
				$message->to(trim($member['email']));
				$message->subject('Practice Tabs Affiliation');
				$message->setBody($member['message'], 'text/html');
			});

			/*\Mail::queue('affiliate.admin-email-template', ['data' => $member], function ($message) use ($member) {

				$message->from('noreply@practicetabs.com', 'practicetabs.com');
				$message->to('mindbender39@gmail.com');
				$message->subject('Practice Tabs Affiliation');
			});*/
		}

		Session::forget('afi_data');
		Session::put('success', 'Record has been saved and emailed to your affiliates');
		return Redirect::to('/member/affiliate');
	}
}