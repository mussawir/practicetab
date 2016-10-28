<?php
namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Supplement;
use App\Models\SupSuggestionsDetails;
use App\Models\SupSuggestionsMaster;
use App\Models\SupSuggestionsSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class SuggestionController extends Controller
{
	var $practitioner_info = null;
	public function __construct()
	{
		$this->practitioner_info = Session::get('parctitioner_session');
		Session::set('marketing', 'active');
		Session::pull('management');
		Session::pull('dashboard');
	}

	public function index()
	{
		/// module:patient
		// view folder name: index
		// file: index

		$sup_requests = DB::table("supplement_requests AS sr")
		->join("patients AS p", "p.pa_id", "=", "sr.pa_id")
		->join("users AS u", "u.user_id", "=", "p.user_id")
		->select('u.first_name', 'u.last_name', 'sr.title',
			'u.cell', 'u.gender', 'u.address')
		->where('sr.pra_id', '=', $this->practitioner_info->pra_id)
		->get();

		return view('practitioner.suggestion.index')
			->with('supplement_requests', $sup_requests);
	}

	public function newSupplementSuggestions()
	{
		$patients = Patient::select('pa_id', 'first_name', 'middle_name', 'last_name')
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name')->get();

		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')->get();

		$unique_ids = array_unique(Session::get('patient_list') ? Session::get('patient_list') : array());
		$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', $unique_ids)->get();

		return view('practitioner.suggestion.new-suggestions')->with('patients', $patients)
			->with('selected_patients', $selected_patients)
			->with('supplements', $supplements);
	}

	public function confirmSupplementSuggestions(Request $request)
	{
		if ($request->method('post')) {
			$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
				->whereIn('sup_id', $request['sup_id'])->get();

			$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $request['pa_id'])->get();

			return view('practitioner.suggestion.confirm-suggestions')
				->with('selected_patients', $selected_patients)
				->with('supplements', $supplements);
		} else {
			return Redirect::Back();
		}
	}

	public function saveSupplementSuggestions(Request $request)
	{
		$master = SupSuggestionsMaster::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'message'	=>	$request['message']
		]);

		foreach ($request['pa_id'] as $pa_id){
			foreach ($request['sup_id'] as $sup_id){
				SupSuggestionsDetails::create([
					'master_id'	=>	$master['id'],
					'pa_id'		=>	$pa_id,
					'sup_id'	=>	$sup_id
				]);
			}
		}

		SupSuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$request['message'],
			'master_id'	=>	$master['id'],
			'pa_ids'		=>	json_encode($request['pa_id']),
			'sup_ids'	=>	json_encode($request['sup_id']),
			'created_at' =>	date('Y/m/d H:i:s')
		]);
		
		Session::forget('patient_list'); // remove by key

		Session::put('success','Suggestions sent to patient(s) successfully!');
		return Redirect::to('/practitioner/suggestion/supplement-suggestions');
	}

	public function getSelectedPatient()
	{
		if(!Session::has('patient_list')){
			Session::put('patient_list', array());
		}
		Session::push('patient_list', Input::get('id'));

		$unique_ids = array_unique(Session::get('patient_list'));

		$patient = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', $unique_ids)->get();

		return Datatables::of($patient)
			->addColumn('Remove', function ($p) {
				return '<input type="hidden" name="pa_id[]" value="'.$p->pa_id.'" />'.
					'<a href="javascript:void(0);" class="text-danger" onclick="removeRow(this, '.$p->pa_id.')"><i class="fa fa-times"></i> Remove</a>';
			})
			->removeColumn('pa_id')
			->make();
	}

	public function removeSelectedPatient()
	{
		$patient_ids = Session::get('patient_list');
		foreach ($patient_ids as $index => $val) {
			if ($val == Input::get('id')) {
				unset($patient_ids[$index]);
			}
		}

		Session::put('patient_list', $patient_ids);
	}
}
