<?php
namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\Nutrition;
use App\Models\NutSuggestionsDetails;
use App\Models\NutSuggestionsMaster;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Supplement;
use App\Models\SupSuggestionsDetails;
use App\Models\SupSuggestionsMaster;
use App\Models\SuggestionsSearch;
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
		$this->practitioner_info = Session::get('practitioner_session');
		Session::set('marketing', 'active');
		Session::pull('management');
		Session::pull('dashboard');
	}

	public function showSupplementSuggestions()
	{
		$list = SuggestionsSearch::where('sug_type', '=', 1)
			->where("pra_id", "=", $this->practitioner_info->pra_id)
			->orderBy('created_at', 'desc')->get();

		return view('practitioner.suggestion.sup-suggestions')->with('list', $list)
			->with('sug_menu', 'active')->with('sup_sug_list', 'active');
	}

	public function supplementSuggestionDetails($id)
	{
		$list = SuggestionsSearch::where('id', $id)->first();
		$supplements = Supplement::select('name', 'used_for', 'main_image', 'short_description')
			->whereIn('sup_id', json_decode($list->sup_ids))->orderBy('name', 'asc')->get();

		$patients = Patient::select('photo', 'email', 'primary_phone', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', json_decode($list->pa_ids))->orderBy('full_name', 'asc')->get();

		return view('practitioner.suggestion.sup-sug-details')->with('list', $list)
			->with('supplements', $supplements)->with('patients', $patients)
			->with('directory', $this->practitioner_info['directory'])->with('sug_menu', 'active');
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

		return view('practitioner.suggestion.new-sup-suggestions')->with('patients', $patients)
			->with('selected_patients', $selected_patients)
			->with('supplements', $supplements)->with('sug_menu', 'active')->with('sup_sug', 'active');
	}

	public function confirmSupplementSuggestions(Request $request)
	{
		if ($request->method('post')) {
			$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
				->whereIn('sup_id', $request['sup_id'])->get();

			$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $request['pa_id'])->get();

			return view('practitioner.suggestion.confirm-sup-suggestions')
				->with('selected_patients', $selected_patients)
				->with('supplements', $supplements)->with('sug_menu', 'active');
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

		SuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$request['message'],
			'master_id'	=>	$master['id'],
			'pa_ids'		=>	json_encode($request['pa_id']),
			'sup_ids'	=>	json_encode($request['sup_id']),
			'created_at' =>	date('Y/m/d H:i:s'),
			'sug_type'	=>	1	// 1=supplement
		]);
		
		Session::forget('patient_list'); // remove by key

		Session::put('success','Supplements suggestions sent to patient(s) successfully!');
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

	/* NUTRITION CODE START */
	public function showNutritionSuggestions()
	{
		$list = SuggestionsSearch::where('sug_type', '=', 2)
			->where("pra_id", "=", $this->practitioner_info->pra_id)
			->orderBy('created_at', 'desc')->get();

		return view('practitioner.suggestion.nut-suggestions')->with('list', $list)
			->with('sug_menu', 'active')->with('nut_sug_list', 'active');
	}

	public function nutritionSuggestionDetails($id)
	{
		$list = SuggestionsSearch::where('id', $id)->first();
		$nutrition = Nutrition::select('name', 'usability', 'main_image', 'short_description')
			->whereIn('nut_id', json_decode($list->nut_ids))->orderBy('name', 'asc')->get();

		$patients = Patient::select('photo', 'email', 'primary_phone', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', json_decode($list->pa_ids))->orderBy('full_name', 'asc')->get();

		return view('practitioner.suggestion.nut-sug-details')->with('list', $list)
			->with('nutrition', $nutrition)->with('patients', $patients)
			->with('directory', $this->practitioner_info['directory'])->with('sug_menu', 'active');
	}

	public function newNutritionSuggestions()
	{
		$patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name')->get();

		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')->get();

		return view('practitioner.suggestion.new-nut-suggestions')->with('patients', $patients)
			->with('nutrition', $nutrition)->with('sug_menu', 'active')->with('nut_sug', 'active');
	}

	public function confirmNutritionSuggestions(Request $request)
	{
		if ($request->method('post')) {
			$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
				->whereIn('nut_id', $request['nut_id'])->get();

			$patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $request['pa_id'])->get();

			return view('practitioner.suggestion.confirm-nut-suggestions')
				->with('patients', $patients)
				->with('nutrition', $nutrition)->with('sug_menu', 'active');
		} else {
			return Redirect::Back();
		}
	}

	public function saveNutritionSuggestions(Request $request)
	{
		$master = NutSuggestionsMaster::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'message'	=>	$request['message']
		]);

		foreach ($request['pa_id'] as $pa_id){
			foreach ($request['nut_id'] as $nut_id){
				NutSuggestionsDetails::create([
					'master_id'	=>	$master['id'],
					'pa_id'		=>	$pa_id,
					'nut_id'	=>	$nut_id
				]);
			}
		}

		SuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$request['message'],
			'master_id'	=>	$master['id'],
			'pa_ids'		=>	json_encode($request['pa_id']),
			'nut_ids'	=>	json_encode($request['nut_id']),
			'created_at' =>	date('Y/m/d H:i:s'),
			'sug_type'	=>	2	// 2=nutrition
		]);

		Session::put('success','Nutrition suggestions sent to patient(s) successfully!');
		return Redirect::to('/practitioner/suggestion/nutrition-suggestions');
	}
}
