<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '1024M');
// use Illuminate\Http\Request;
// use Illuminate\Routing\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use Illuminate\Http\Request;

require base_path("vendor/autoload.php");

class sendEmail extends Controller{
    public function sendContactMail(){
       
       $name=ucwords($_POST['firstname']).' '.ucwords($_POST['secondname']);
       $email=ucwords($_POST['email']);
       $msg=ucwords($_POST['msg']);
       $array=['alamriahmad895@gmail.com','sumaiaamjed022@gmail.com','yaraalkhazaleh650@gmail.com'];
       $array1=['mazenasfour6@gmail.com'];
       DB::table('contact')->insert([
        'name'=>$name,
        'email'=>$email,
        'message'=>$msg
        ]);
      
            for($i=0;$i<count($array);$i++){
                $mail = new PHPMailer(true);     // Passing `true` enables exceptions
                // Email server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';             //  smtp host
                $mail->SMTPAuth = true;
                $mail->Username = 'mazenasfour6@gmail.com'; //   //  sender username
                $mail->Password = 'apcsbrnfwompvwrk';       // sender password
                $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                $mail->Port = 587;                          // port - 587/465
    
                $mail->setFrom(''.$email.'', ''.$name.'');
                $mail->addAddress($array[$i]);
                $mail->addCC('RoyalMoon@gmail.com');
                
                $mail->addBCC($array[$i]);
                $mail->isHTML(true);                // Set email content format to HTML
                $mail->Subject = 'New Contact Message';
                $mail->Body    = '<h1 style="font-size:16px;padding:2px 0;font-famliy:sans-serif"> Hello Admin </h1> You Recived New Contact Massege From :<span style="color:rgba(128, 91, 135, 0.9)">'.$email.'</span><Massege :<br "><div style="padding:10px 0">'.$msg.'</div><div style="padding:5px 0"><a href="http://localhost:8000/admin/contact?email=' .$email .'&&name=' .$name .'\">Contact User</a></div>';
                if( !$mail->send() ) {
                    echo 'not send';
                }
                
                else {
                    echo 'email sent';
                }
            }
            
            
    }
    public function viewresponse(){
        $name=$_GET['name'];
        $email=$_GET['email'];
        return view('admin/contactWithUser')->with('email',$email)->with('name',$name);
    }

    public function sendContactMailAdmin(Request $request){
        $email=$request->email;
        $name=$request->name;
        $msg=$request->msg;

         $mail = new PHPMailer(true);     // Passing `true` enables exceptions
 
      
             // Email server settings
             $mail->SMTPDebug = 0;
             $mail->isSMTP();
             $mail->Host = 'smtp.gmail.com';             //  smtp host
             $mail->SMTPAuth = true;
             $mail->Username = 'mazenasfour6@gmail.com'; //   //  sender username
             $mail->Password = 'apcsbrnfwompvwrk';       // sender password
             $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
             $mail->Port = 587;                          // port - 587/465
 
             $mail->setFrom('test5555567@mailinator.com', 'RoyalMoon');
             $mail->addAddress('RoyalMoon@gmail.com');
             $mail->addCC('RoyalMoon@gmail.com');
             $mail->addBCC(''.$email.'');
 
             // $mail->addReplyTo('sender@example.com', 'SenderReplyName');
 
             $mail->isHTML(true);                // Set email content format to HTML
 
             $mail->Subject = 'New Contact Email';
             $mail->Body    = '<h1 style="font-size:16px;padding:2px 0;font-famliy:sans-serif"> Hello '.$name.'.</h1><p>'.$msg.'</p>';
             // $mail->AltBody = plain text version of email body;
             if( !$mail->send() ) {
                 die();
             }
             else {
                Contact::where("id",$request->id)->update([
                    "replayed"=>true
                ]);
                 return('email sent');
             }
            //  die('email sent successfully');
 
 }
 public function verfificationCode($number, $email){

     $mail = new PHPMailer(true);     // Passing `true` enables exceptions

  
         // Email server settings
         $mail->SMTPDebug = 0;
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';             //  smtp host
         $mail->SMTPAuth = true;
         $mail->Username = 'mazenasfour6@gmail.com'; //   //  sender username
         $mail->Password = 'apcsbrnfwompvwrk';       // sender password
         $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
         $mail->Port = 587;                          // port - 587/465

         $mail->setFrom('Mazenasfour6@gmail.com', 'RoyalMoon');
         $mail->addAddress('RoyalMoon@gmail.com');
         $mail->addCC('RoyalMoon@gmail.com');
         $mail->addBCC(''.$email.'');

         // $mail->addReplyTo('sender@example.com', 'SenderReplyName');

         $mail->isHTML(true);                // Set email content format to HTML

         $mail->Subject = 'New Contact Email';
         $mail->Body    = '<h1 style="font-size:16px;padding:2px 0;font-famliy:sans-serif"> Verification Code : </h1><p>'.$number.'</p>';
         // $mail->AltBody = plain text version of email body;
         if( !$mail->send() ) {
             die();
         }
         else {
             return('email sent');
         }
        //  die('email sent successfully');

}
    public function notify_user_on_appointment($name,$email,$date,$product,$price){
        
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        $message = "<div>Hey ".$name.".</div><div> We want to let you know that your appointment has been approved. </div><div> Camping choosed :".$product."</div><div>Date : ".$date."</div><div> Total price : ".$price." </div>";
        // Email server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';             //  smtp host
        $mail->SMTPAuth = true;
        $mail->Username = 'mazenasfour6@gmail.com'; //   //  sender username
        $mail->Password = 'apcsbrnfwompvwrk';       // sender password
        $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
        $mail->Port = 587;                          // port - 587/465

        $mail->setFrom('Mazenasfour6@gmail.com', 'RoyalMoon');
        $mail->addAddress('RoyalMoon@gmail.com');
        $mail->addCC('RoyalMoon@gmail.com');
        $mail->addBCC(''.$email.'');

        // $mail->addReplyTo('sender@example.com', 'SenderReplyName');

        $mail->isHTML(true);                // Set email content format to HTML

        $mail->Subject = 'New Contact Email';
        $mail->Body    = '<h1 style="font-size:16px;padding:2px 0;font-famliy:sans-serif"> Approved Appointment </h1><p>'.$message.'</p> Thanks You ,Regards.';
        // $mail->AltBody = plain text version of email body;
        if( !$mail->send() ) {
            die();
        }
        else {
            return('email sent');
        }
    }
}