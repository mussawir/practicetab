<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateContact;
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
		$list = AffiliateContact::where('afi_id', '=', $this->member_info->id)
			->orderBY('last_invite_at', 'desc')->get();
		return view('member.affiliate.index')->with('list', $list)
			->with('page_title', 'Practitioners/Members List')
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
				Session::put('error', 'Practitioner already added');
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

			$member = AffiliateContact::create([
				'first_name' => $inputs['first_name'][$i],
				'last_name' => $inputs['last_name'][$i],
				'email' => $inputs['email'][$i],
				'phone' => $inputs['phone'][$i],
				'message' => $inputs['message'],
				'afi_id' => $this->member_info->id,
				'invitation_count' => 1,
				'last_invite_at' => date('Y/m/d H:i:s')
			]);

			\Mail::queue([], [], function ($message) use ($member) {

				$message->from('noreply@practicetabs.com', 'practicetabs.com');
				$message->to(trim($member['email']));
				$message->subject('Invitation - Practice Tabs');
				$message->setBody($member['message'], 'text/html');
			});

			/*\Mail::queue('affiliate.admin-email-template', ['data' => $member], function ($message) use ($member) {

				$message->from('noreply@practicetabs.com', 'practicetabs.com');
				$message->to('mindbender39@gmail.com');
				$message->subject('Practice Tabs Affiliation');
			});*/
		}

		Session::forget('afi_data');
		Session::put('success', 'An invitation has been sent to your Practitioner(s)');
		return Redirect::to('/member/affiliate');
	}

	public function showExistingContacts(Request $request)
	{
		$list = AffiliateContact::whereIn('id', $request['id'])->get();
		return view('member.affiliate.resend')
			->with('list', $list);
	}

	public function resendInvitation(Request $request)
	{
		$inputs = $request->all();

		for ($i = 0; $i < count($inputs['id']); $i++)
		{
			$member = AffiliateContact::where('id', '=', $inputs['id'][$i])->first();
			$member->invitation_count = $member->invitation_count +1;
			$member->last_invite_at = date('Y/m/d H:i:s');
			$member->save();

			\Mail::queue([], [], function ($message) use ($member, $inputs) {

				$message->from('noreply@practicetabs.com', 'practicetabs.com');
				$message->to(trim($member['email']));
				$message->subject('Invitation - Practice Tabs');
				$message->setBody($inputs['message'], 'text/html');
			});
		}

		Session::put('success', 'An invitation has been sent to your Practitioner(s)');
		return Redirect::to('/member');
	}
}