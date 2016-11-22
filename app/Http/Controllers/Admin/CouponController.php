<?php

namespace App\Http\Controllers\Admin;

use App\Models\ad_coupon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;
use App\Models\coupon;

class CouponController extends Controller
{
    protected $baseUrl;

    public function __construct(UrlGenerator $url)
    {
        $this->baseUrl = $url;
    }
    public function index()
    {
        $coupon = ad_coupon::select('*')->orderBy('expiryDate', 'asc')->get();
        $meta = array('page_title'=>'Coupons', 'coupon_menu'=>'active', 'list_coupon'=> 'active', 'item_counter'=>(isset($coupon)?count($coupon):0));

        return view('admin.ad_coupon.index')->with('coupon', $coupon)->with('meta', $meta)
            ->with('coupon_menu', 'active')->with('list_coupon', 'active');
    }
    public function Create()
    {
        return view('admin.ad_coupon.new')
            ->with('coupon_menu', 'active')->with('new_coupon', 'active')
            ;
    }
    public function generateCoupons($maxNumberOfCoupons,$generate)
    {
        $couponss = [];
        for ($i = 0; $i < $maxNumberOfCoupons; $i++) {
        $coupon = new coupon();
        if($generate =='1')
        {
            $coupons = $coupon::generate(6, '','', true);
        }
        else if($generate=='2')
        {
            $coupons= $coupon::generate(6, "", "", false, true);
        }
        else if($generate=='3')
        {
            $coupons = $coupon::generate(1, "", "", true, true, false, false, "XXXXXX");
        }
            $couponss[] = $coupons;
        }
        return $couponss;
    }
    public function printCoupon($id)
    {
        $counter=0;
        #couponCode = '';
        $coupon = ad_coupon::where('cId','=',$id)->get();
        if(isset($coupon)&&(!empty($coupon)))
        {
            foreach($coupon as $record){
                $couponCode = $record->cCode;
            }

            $counter = explode(',',$couponCode);
            $pdf = \PDF::loadView('admin.ad_coupon.coupon-pdf', array('data'=>$coupon,'counter'=>count($counter)));
            //return view('admin.ad_coupon.coupon-pdf')->with('data', $coupon)->with('counter',count($counter));
            return $pdf->stream();//download('Quotation_'.$pdf_data[0]->job_code.'.pdf');
        }
        else
        {
            Session::put('error','Record Not Found');
            return Redirect::Back();
        }
    }
    public function store(Request $request)
    {

        $validator = \Validator::make($request->toArray(), [
            'expiryDate' => 'required'
        ]);
        $input = $request->all();
        $filename='';
        if($request->hasFile('cFile')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('cFile');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();
            if (!file_exists(public_path().'/dashboard/img/coupon')) {
                mkdir(public_path().'/dashboard/img/coupon', 0777, true);
            }
            $file->move(public_path().'/dashboard/img/coupon/', $filename);
        }
        $counter = $input['noCoupons'];
        $prefix = isset($input['prefix']) ? $input['prefix'] : '';
        $suffix = isset($input['suffix']) ? $input['suffix'] : '';
        $counter = $counter == '' ? 0 : $counter;
        $counter = $counter ==0 ? 1 : $counter;
        $generate=isset($input['generateType'])? $input['generateType'] : '1';
        //if($generate =='1')
        //{
            $coupons = $this->generateCoupons($counter,$generate);
        //}
        $couponCode='';
        foreach ($coupons as $key => $value)
        {
            $couponCode .= $value;
            $couponCode .= ',';
        }
        $couponCode = rtrim($couponCode, ",");
        $input['generatedBy'] = Auth::user()->user_id;
        $input['cCode'] = $couponCode;
        $input['cFile'] = $filename;

        ad_coupon::create($input);
        Session::put('success','Coupon Generated Successfully!');
        return Redirect::Back();
    }
}
