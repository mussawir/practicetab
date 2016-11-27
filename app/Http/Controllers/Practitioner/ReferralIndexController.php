<?php

namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Affiliate;
use App\Models\AffiliateContact;
use App\Models\Practitioner;
use App\Models\PractitionerReferral;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class ReferralIndexController extends Controller
{
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
    }

    public function index()
    {
        $list = PractitionerReferral::where('pra_id', '=', $this->practitioner_info->pra_id)
            ->orderBY('last_invite_at', 'desc')->get();

        return view('practitioner.referral.referral-index')->with('list', $list);

    }


}