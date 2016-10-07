<?php namespace App\Modules\Practitioner\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Practitioner\Models\TestModel;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class IndexController extends Controller
{
	function __construct( TestModel $testModel )
	{
		$this->testModel = $testModel;
	}

	public function index()
	{
		// ModuleOne is the module name and dummy is the blade file
		// you can specify ModuleOne::someFolder.file if your file exists
		// inside a folder. Also the blade will use the same syntax i.e.
		// ModuleName::viewName
		return view('Practitioner::index')->with('hide_sidebar', 'no-sidebar');
	}

	public function modelTest()
	{
		// Added just to demonstrate that models work
		return $this->testModel->getAny();
	}

	public function viewMarketing()
	{
		return view('Practitioner::marketing');
	}

	public function viewManagement()
	{
		return view('Practitioner::management');
	}
}
