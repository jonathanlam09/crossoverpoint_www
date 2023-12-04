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

            if(!isset($param["first_name"])){
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