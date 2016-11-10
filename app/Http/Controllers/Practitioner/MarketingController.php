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
            $link='';
            $imagePath='';
            $success = FALSE;
            $error = FALSE;
            if(isset($_POST["link"]))
            {
                $link = $_POST["link"];
            }
            if(isset($_POST["imagePath"]))
            {
                $imagePath = $_POST["imagePath"];
            }

            if($link=="") {
                $msg = $_POST["msg"];
                $param = array('message' => $msg);
                try {
                    $posted = $facebook->api('/me/feed/', 'post', $param);
                    if (strlen($posted["id"]) > 0) $success = TRUE;
                } catch (FacebookApiException $e) {
                    $errMsg = $e->getMessage();
                    $error = TRUE;
                    $myerr = $errMsg;
                }
                if ($success) echo 'posted';
                if ($error) echo 'error' . $myerr;
            }
            else if($link!=""&$imagePath=="")
            {
                $msg = $_POST["msg"];
                $param = array(
                    'message' => $msg,
                    'link' => $link,
                );

                try {
                    $posted = $facebook->api('/me/feed/', 'post', $param);
                    if (strlen($posted["id"]) > 0 ) $success = TRUE;
                } catch  (FacebookApiException $e) {
                    $errMsg = $e->getMessage();
                    $error = TRUE;
                    $myerr=$errMsg;
                }
                if ($success) echo 'posted';
                if ($error) echo 'error' . $myerr;
            }
            /*(else if($imagePath!="") {

                $msg = $_POST["msg"];
                $param = array(
                    'message' => $msg,
                    'picture' => 'http://ajaxuploader.com/images/drag-drop-file-upload.png',
                    'caption' => $msg,
                );
                try {
                    $posted = $facebook->api('/me/feed/', 'post', $param);
                    if (strlen($posted["id"]) > 0 ) $success = TRUE;
                } catch  (FacebookApiException $e) {
                    $errMsg = $e->getMessage();
                    $error = TRUE;
                    $myerr=$errMsg;
                }
                if ($success) echo 'posted';
                if ($error) echo 'error' . $myerr;
            }*/



        }
    }
    function uploadImage()
    {
        $target_dir = public_path() . '/dashboard/img/marketing-img/';
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir .uniqid(). basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                //echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                echo $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
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
