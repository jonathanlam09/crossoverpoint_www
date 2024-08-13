<?php
use PHPMailer\PHPMailer\PHPMailer;

class Mailer {
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        // $this->mail->SMTPDebug = 2; 
        $this->mail->isSMTP();               
        $this->mail->Host       = env("SMTP_HOST");  
        $this->mail->SMTPAuth   = true;           
        $this->mail->Username   = env("SMTP_USERNAME");
        $this->mail->Password   = env("SMTP_PASSWORD");   
        $this->mail->Port       = env("SMTP_PORT");  
        $this->mail->SMTPSecure = "ssl";             
    }

    public function test($email){
        $this->mail->setFrom(env("SMTP_USERNAME"), "Casper @ Crossover Point");          
        $this->mail->addAddress($email, "Jonathan Lam");          
        $this->mail->Subject = "Admin portal invitation";
        $this->mail->isHTML(true);                             
        $this->mail->Body   = "test";
        $this->mail->AltBody = "This is the body in plain text for non-HTML mail clients";
        if(!$this->mail->send()){
            throw new Exception("Error sending email!");
        }
    }

    public function service_sign_up($param){
        $ret = [
            "status" => false
        ];

        try{
            if(!isset($param["email"])){
                throw new Exception("Empty email!");
            }

            if(!isset($param["first_name"])){
                throw new Exception("Empty first name!");
            }

            if(!isset($param["last_name"])){
                throw new Exception("Empty last name!");
            }

            if(!isset($param["contact"])){
                throw new Exception("Empty contact!");
            }

            if(!isset($param["service"])){
                throw new Exception("Empty service!");
            }
           
            $this->mail->setFrom(env("SMTP_USERNAME"), "Casper @ Crossover Point");          
            $this->mail->addAddress($param["email"], "CROSSOVER POINT");          
            $this->mail->Subject = "Event Registration Confirmation";
            $this->mail->isHTML(true);                             
            $this->mail->Body    = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='background-color:#F2F2F2;padding:50px;'>
                                        <tr>
                                            <td align='center'>
                                                <img src='https://admin.crossoverpoint.org.my/assets/img/logo.png' style='height:200px;float:center;'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3>Greetings,</h3>
                                                <p>" . ucfirst($param["first_name"]) . " " . ucfirst($param["last_name"]) . "!</p>
                                                <p>There email is to confirm your registration for the attached event!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='center'>
                                                <div style='background-color:lightgrey;width:80%;padding:30px;margin:50px 0px;'>
                                                    <div>
                                                        <img style='width:100%;max-width:400px;border-radius:1vh;' src='https://admin.crossoverpoint.org.my/assets/img/service/" . $param["service"]->image . "'/>
                                                    </div>
                                                    <div style='max-width:500px;'>
                                                        <p align='left' style='margin:0;margin-top:1.5rem;'>Name: " . $param["service"]->title . "</p>
                                                        <p align='left' style='margin:0;'>Description: " . $param["service"]->description . "</p>
                                                        <p align='left' style='margin:0;'>Start Date: " . date("jS F Y 10:00:00 A", strtotime($param["service"]->date)) . "</p>
                                                        <p align='left' style='margin:0;'>End Date: " . date("jS F Y 12:00:00 A", strtotime($param["service"]->date)) . "</p>
                                                        <p align='left' style='margin:0;'>Speaker: " . $param["service"]->speaker ?  $param["service"]->speaker->getFullname() : $param["service"]->speaker_name .  "</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style='margin:0;padding:0;margin-top:15px;'>God Bless,</p>
                                                <p style='margin:0;margin-top:10px;'>Casper</p>
                                                <h3 style='margin:0;'>Crossover Point</h3>
                                            </td>
                                        </tr>
                                    </table>";
            $this->mail->AltBody = "This is the body in plain text for non-HTML mail clients";
            if(!$this->mail->send()){
                throw new Exception("Error sending email!");
            }
            $ret["status"] = true;
        }catch(\PHPMailer\PHPMailer\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return $ret;
    }

    public function event_sign_up($param){
        $ret = [
            "status" => false
        ];

        try{
            if(!isset($param["email"])){
                throw new Exception("Empty email!");
            }

            if(!isset($param["first_name"])){
                throw new Exception("Empty first name!");
            }

            if(!isset($param["last_name"])){
                throw new Exception("Empty last name!");
            }

            if(!isset($param["contact"])){
                throw new Exception("Empty contact!");
            }

            if(!isset($param["event"])){
                throw new Exception("Empty event!");
            }
           
            $this->mail->setFrom(env("SMTP_USERNAME"), "Casper @ Crossover Point");          
            $this->mail->addAddress($param["email"], "CROSSOVER POINT");          
            $this->mail->Subject = "Event Registration Confirmation";
            $this->mail->isHTML(true);                             
            $this->mail->Body    = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='background-color:#F2F2F2;padding:50px;'>
                                        <tr>
                                            <td align='center'>
                                                <img src='https://admin.crossoverpoint.org.my/assets/img/logo.png' style='height:200px;float:center;'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3>Greetings,</h3>
                                                <p>" . ucfirst($param["first_name"]) . " " . ucfirst($param["last_name"]) . "!</p>
                                                <p>There email is to confirm your registration for the attached event!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='center'>
                                                <div style='background-color:lightgrey;width:80%;padding:30px;margin:50px 0px;'>
                                                    <div>
                                                        <img style='width:100%;max-width:400px;border-radius:1vh;' src='https://admin.crossoverpoint.org.my/assets/img/event/" . $param["event"]->image . "'/>
                                                    </div>
                                                    <div style='max-width:500px;'>
                                                        <p align='left' style='margin:0;margin-top:1.5rem;'>Name: " . $param["event"]->name . "</p>
                                                        <p align='left' style='margin:0;'>Description: " . $param["event"]->description . "</p>
                                                        <p align='left' style='margin:0;'>Start Date: " . date("jS F Y H:i:s A", strtotime($param["event"]->start_date)) . "</p>
                                                        <p align='left' style='margin:0;'>End Date: " . date("jS F Y H:i:s A", strtotime($param["event"]->end_date)) . "</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style='margin:0;padding:0;margin-top:15px;'>God Bless,</p>
                                                <p style='margin:0;margin-top:10px;'>Casper</p>
                                                <h3 style='margin:0;'>Crossover Point</h3>
                                            </td>
                                        </tr>
                                    </table>";
            $this->mail->AltBody = "This is the body in plain text for non-HTML mail clients";
            if(!$this->mail->send()){
                throw new Exception("Error sending email!");
            }
            $ret["status"] = true;
        }catch(\PHPMailer\PHPMailer\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return $ret;
    }

    public function enquiry($param){
        $ret = [
            "status" => false
        ];

        try{
            if(!isset($param["email"])){
                throw new Exception("Empty email!");
            }

            if(!isset($param["first_name"])){
                throw new Exception("Empty first name!");
            }

            if(!isset($param["last_name"])){
                throw new Exception("Empty last name!");
            }

            if(!isset($param["contact"])){
                throw new Exception("Empty contact!");
            }

            if(!isset($param["type_of_enquiry"])){
                throw new Exception("Empty type of enquiry!");
            }

            if(!isset($param["remarks"])){
                throw new Exception("Empty remarks!");
            }

            $this->mail->setFrom(env("SMTP_USERNAME"), "Casper @ Crossover Point");          
            $this->mail->addAddress("wongkearkyii@hotmail.com", "CROSSOVER POINT");     
            $this->mail->addAddress("jonathanlam09@gmail.com", "CROSSOVER POINT");          
            $this->mail->Subject = "Enquiry";
            $this->mail->isHTML(true);                             
            $this->mail->Body    = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='background-color:#F2F2F2;padding:50px;'>
                                        <tr>
                                            <td align='center'>
                                                <img src='https://admin.crossoverpoint.org.my/assets/img/logo.png' style='height:200px;float:center;'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3>Greetings,</h3>
                                                <p>Crossover Point Admin!</p>
                                                <p>There is a new enquiry!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='center'>
                                                <div style='background-color:lightgrey;width:80%;padding:30px;margin:50px 0px;'>
                                                    <div style='max-width:500px;'>
                                                        <p align='left' style='margin:0;margin-top:1.5rem;'>First name: " . ucfirst($param["first_name"]) . "</p>
                                                        <p align='left' style='margin:0;'>Last name: " . ucfirst($param["last_name"]) . "</p>
                                                        <p align='left' style='margin:0;'>Email: " . $param["email"] . "</p>
                                                        <p align='left' style='margin:0;'>Contact: " . $param["contact"] . "</p>
                                                        <p align='left' style='margin:0;'>Type of Enquiry: " . $param["type_of_enquiry"] . "</p>
                                                        <p align='left' style='margin:0;'>Remarks: " . $param["remarks"] . "</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style='margin:0;padding:0;margin-top:15px;'>God Bless,</p>
                                                <p style='margin:0;margin-top:10px;'>Casper</p>
                                                <h3 style='margin:0;'>Crossover Point</h3>
                                            </td>
                                        </tr>
                                    </table>";
            $this->mail->AltBody = "This is the body in plain text for non-HTML mail clients";
            if(!$this->mail->send()){
                throw new Exception("Error sending email!");
            }
            $ret["status"] = true;
        }catch(\PHPMailer\PHPMailer\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return $ret;
    }
}
?>