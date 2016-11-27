<?php

namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\Practitioner;
use App\Models\Affiliate;
use App\Models\AffiliateContact;
use App\Models\PractitionerReferral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class ReferralController extends Controller
{
	public function __construct()
	{
		$this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
	}

	public function index()
	{
		$list = PractitionerReferral::where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBY('last_invite_at', 'desc')->get();
		return view('practitioner.referral.index')->with('list', $list)
			->with('page_title', 'Practitioners/Referral List');
	}

	public function create()
	{
		$list = Session::has('ref_data') ? Session::get('ref_data') : array();
		$my_info = Practitioner::where('pra_id', '=', $this->practitioner_info->pra_id)->first();
		return view('practitioner.referral.new')->with('my_info', $my_info)
			->with('list', $list);
	}

	public function createList(Request $request)
	{
		$session_data = Session::has('ref_data') ? Session::get('ref_data') : array();
		foreach ($session_data as $data) {
			if ($data['email'] == $request['email']) {
				Session::put('error', 'Practitioner already added');
				return Redirect::Back();
			}
		}

		Session::push('ref_data', array(
			'first_name'=>$request['first_name'],
			'last_name'=>$request['last_name'],
			'phone'=>$request['phone'],
			'email'=>$request['email']
		));

		return Redirect::Back();
	}

	public function removeAddedMember()
	{
		$data = Session::get('ref_data');
		foreach ($data as $index => $val) {
			if ($val['email'] == Input::get('email')) {
				unset($data[$index]);
			}
		}

		Session::put('ref_data', $data);
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

			$referral = PractitionerReferral::create([
				'first_name' => $inputs['first_name'][$i],
				'last_name' => $inputs['last_name'][$i],
				'email' => $inputs['email'][$i],
				'phone' => $inputs['phone'][$i],
				'message' => $inputs['message'],
				'pra_id' => $this->practitioner_info->pra_id,
				'invitation_count' => 1,
				'last_invite_at' => date('Y/m/d H:i:s')
			]);
			$data = [
				'messagebody'=>  $inputs['message'],
			];
			Mail::send(['html' => 'practitioner.referral.member-email-template'], $data, function ($message) use ($referral) {
				$message->from('noreply@practicetabs.com', 'Practice Tabs');
				$message->to($referral['email']);
				$message->subject('Invitation - Practice Tabs');
			});
//			\Mail::queue([], [], function ($message) use ($member) {
//
//				$message->from('noreply@practicetabs.com', 'practicetabs.com');
//				$message->to(trim($member['email']));
//				$message->subject('Invitation - Practice Tabs');
//				$message->setBody($member['message'], 'text/html');
//			});

			/*\Mail::queue('affiliate.admin-email-template', ['data' => $member], function ($message) use ($member) {

				$message->from('noreply@practicetabs.com', 'practicetabs.com');
				$message->to('mindbender39@gmail.com');
				$message->subject('Practice Tabs Affiliation');
			});*/
		}

		Session::forget('ref_data');
		Session::put('success', 'An invitation has been sent to your Practitioner(s)');
		return Redirect::to('/practitioner/referral');
	}

	public function showExistingContacts(Request $request)
	{
		$list = PractitionerReferral::whereIn('id', $request['id'])->where('pra_id',$this->practitioner_info->pra_id)->get();
		return view('practitioner.referral.resend')
			->with('list', $list);
	}

	public function resendInvitation(Request $request)
	{
		$inputs = $request->all();

		for ($i = 0; $i < count($inputs['id']); $i++)
		{
			$member = PractitionerReferral::where('id', '=', $inputs['id'][$i])->first();
			$member->invitation_count = $member->invitation_count +1;
			$member->last_invite_at = date('Y/m/d H:i:s');
			$member->save();

			$data = [
				'messagebody'=>  $inputs['message'],
			];
			Mail::send(['html' => 'practitioner.referral.member-email-template'], $data, function ($message) use ($member) {
				$message->from('noreply@practicetabs.com', 'Practice Tabs');
				$message->to($member['email']);
				$message->subject('Invitation - Practice Tabs');
			});
		}

		Session::put('success', 'An invitation has been sent to your Practitioner(s)');
		return Redirect::to('/practitioner/referral');
	}
}