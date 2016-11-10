<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Practitioner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class MarketingController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
      Session::set('marketing', 'active');
      Session::pull('management');
      Session::pull('dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('practitioner.marketing.index');
    }
    public function SocialPost()
    {
        return view('practitioner.marketing.social');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function logoutFb()
    {
        session_start();
        $_SESSION = array();
        unset($_SESSION);
        session_destroy();
        return Redirect::to('practitioner/SocialPost');
    }
    public function formsubmit()
    {
        require_once 'App\Models\FBCONFIG.php';
        //if(isset($_POST["mode"]) && $_POST["mode"] == "type1")
        {
            $myerr='';
            $msg = $_POST["msg"];
            $param = array( 'message' => $msg );
            $success = FALSE;
            $error = FALSE;
            try {
                $posted = $facebook->api('/me/feed/', 'post', $param);
                if (strlen($posted["id"]) > 0 ) $success = TRUE;
            } catch  (FacebookApiException $e) {
                $errMsg = $e->getMessage();
                $error = TRUE;
                $myerr=$errMsg;
            }
            if($success) return 'posted';
            if($error) return 'error'. $myerr;

        }
    }
    public function fblogin()
    {
        require_once 'App\Models\FBCONFIG.php';
        session_start();
        $_SESSION["user_id"] = getuser();
        $userID = getuser();
        //echo $userID;
// Only if user is logged in and given permission, we can fetch user details
        //return Redirect::Back();
        if ($userID=="") {
            try {
                if ($_SESSION["user_id"] == "") {
                    // fetch user details.
                    $user_profile = $facebook->api('/me');

                    // Now check if user exist with same email ID
                    $sql = "SELECT COUNT(*) AS count from usersFb where email = :email_id";
                    try {
                        {
                            // New user, Insert in database
                            $sql = "INSERT INTO `usersFb` (`name`, `email`) VALUES " . "( :name, :email)";
                            $stmt = $DB->prepare($sql);
                            $stmt->bindValue(":name", $user_profile["name"]);
                            $stmt->bindValue(":email", $user_profile["email"]);
                            $stmt->execute();
                            $result = $stmt->rowCount();
                            if ($result > 0) {
                                $_SESSION["name"] = $user_profile["name"];
                                $_SESSION["email"] = $user_profile["email"];
                                $_SESSION["new_user"] = "yes";
                            }
                        }
                    } catch (Exception $ex) {
                        echo $ex;
                    }

                    //return Redirect::Back();
                    //return Redirect::to('practitioner/SocialPost');
                }
                $_SESSION["user_id"] = $userID;
                return Redirect::to('practitioner/SocialPost');
            } catch (FacebookApiException $e) {
                echo $e;
                $userID = NULL;
            }
        } else {
            return Redirect::to('practitioner/SocialPost');
        }
    }

}
