@include("include/header")
<style>
    .required-star{
        display: none;
        font-size: .45rem;
        color:red;
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>MEMBERSHIP</h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <form method="post" action="api/signup">
        <div class="progress" style="display: none;">
            <div class="progress-bar" role="progressbar" aria-valuenow="70"
            aria-valuemin="0" aria-valuemax="100" style="width:0%;background-color:grey;" id="progress_bar">
            </div>
        </div>

        <div class="membership-form-div mt-5">
            <div id="start_membership_process">
                <div class="d-flex justify-content-center mb-5" id="membership_img" 
                style="transform:translateY(50%);transition-duration:1.5s;opacity:.2;">
                    <img src="<?php echo url("assets/img/membership.png")?>" 
                    style="max-height:350px;" 
                    class="img-fluid">
                </div>
                <div id="membership_paragraph" style="white-space:pre;text-align:center;">
                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, 
                    making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, 
                    looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, 
                    and going through the cites of the word in classical literature, discovered the undoubtable source. 
                    Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" 
                    (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
                    very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
            
                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 
                    from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, 
                    accompanied by English versions from the 1914 translation by H. Rackham.
                </div>
                <div class="d-flex justify-content-center mt-5" id="membership_start" style="transform:translateY(50%);transition:1.5s ease-out;opacity:.2;">
                    <a class="btn btn-primary" onclick="start()">START</a>
                </div>
            </div>
            <div class="justify-content-center" id="spinner" style="display:none;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="salutation-div" style="display:none;">
                <div class="d-flex salutation-validate">
                    <h5>What is your salutation?</h5>
                    <i class="fa fa-asterisk required-star" id="salutation_star"></i>
                </div>
                <div style="margin-top:50px;">
                    <div>
                        <input type="radio" value="mr" id="mr" name="salutation">
                        <label for="mr">Mr</label>
                    </div>
                    <div>
                        <input type="radio" value="mrs" id="mrs" name="salutation">
                        <label for="mrs">Mrs</label>
                    </div>
                    <div>
                        <input type="radio" value="ms" id="ms" name="salutation">
                        <label for="ms">Ms</label>
                    </div>
                </div>
            </div>
            <div class="name-div" style="display:none;">
                <div class="d-flex">
                    <h5>What is your name?</h5>
                    <i class="fa fa-asterisk required-star" id="name_star"></i>
                </div>
                <div class="row" style="margin-top:50px;">
                    <div class="col-md-6 col-12">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name">
                    </div>
                    <div class="col-md-6 col-12">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name">
                    </div>
                </div>
            </div>
            <div class="email-div" style="display:none;">
                <div class="d-flex">
                    <h5>What is your email address and contact?</h5>
                    <i class="fa fa-asterisk required-star" id="email_star"></i>
                </div>
                <div class="row" style="margin-top:50px;">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Eg. johndoe@crossoverpoint.com">
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="contact" id="contact" placeholder="Eg. 0123456789">
                    </div>
                </div>
            </div>
            <div class="religion-div" style="display:none;">
                <div class="d-flex religion-validate">
                    <h5>What is your religion?</h5>
                    <i class="fa fa-asterisk required-star" id="religion_star"></i>
                </div>
                <div class="row" style="margin-top:50px;">
                    <div class="col-12">
                        <div>
                            <input type="radio" value="christian" name="religion">
                            <label for="christian">Christian</label>
                        </div>
                        <div>
                            <input type="radio" value="muslim" name="religion">
                            <label for="muslim">Muslim</label>
                        </div>
                        <div>
                            <input type="radio" value="buddhist" name="religion">
                            <label for="buddhist">Buddhist</label>
                        </div>
                        <div>
                            <input type="radio" value="hindu" name="religion">
                            <label for="hindu">Hindu</label>
                        </div>
                        <div>
                            <input type="radio" value="other" name="religion">
                            <label for="other">Other</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="attend-church-div" style="display:none;">
                <div class="d-flex attend-church-validate">
                    <h5>Are you currently attending any church?</h5>
                    <i class="fa fa-asterisk required-star" id="attend_church_star"></i>
                </div>
                <div class="row" style="margin-top:50px;">
                    <div class="col-12">
                        <input type="radio" value="1" name="is_attend_church">
                        <label for="yes_church">Yes</label>
                        <input type="radio" value="0" name="is_attend_church" style="margin-left:20px;">
                        <label for="no_church">No</label>
                    </div>
                </div>
            </div>
            <div class="church-div" style="display:none;">
                <h5>What is your church name?</h5>
                <div class="row" style="margin-top:50px;">
                    <div class="col-12">
                        <input type="text" name="church" id="church" class="form-control" placeholder="Eg. Crossover point">
                    </div>
                </div>
            </div>
            <div class="extra-details-div" style="display:none;">
                <h5>Extra information</h5>
                <div class="row" style="margin-top:50px;">
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="">Date of Birth</label>
                        <div>
                            <input type="date" name="dob" class="form-control" id="dob">
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="">Marital Status</label>
                        <div>
                            <select name="marital_status" id="marital_status" class="form-control">
                                <option value="">Select marital status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="">Working Industry</label>
                        <div>
                            <input type="text" name="industry" class="form-control" id="industry">
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="">Occupation</label>
                        <div>
                           <input type="text" name="occupation" class="form-control" id="occupation">
                        </div>
                    </div>
                    <div class="col-12 mt-4 form-group">
                        <label for="">Address</label>
                        <div>
                            <input type="text" class="form-control" id="address">
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="country">Country</label>
                        <div>
                            <select name="country" id="country" class="form-control">
                                <option value="">Select country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AX">Aland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BY">Belarus</option>
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia</option>
                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                <option value="BA">Bosnia and Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BV">Bouvet Island</option>
                                <option value="BR">Brazil</option>
                                <option value="IO">British Indian Ocean Territory</option>
                                <option value="BN">Brunei Darussalam</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="KH">Cambodia</option>
                                <option value="CM">Cameroon</option>
                                <option value="CA">Canada</option>
                                <option value="CV">Cape Verde</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="CF">Central African Republic</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="CN">China</option>
                                <option value="CX">Christmas Island</option>
                                <option value="CC">Cocos (Keeling) Islands</option>
                                <option value="CO">Colombia</option>
                                <option value="KM">Comoros</option>
                                <option value="CG">Congo</option>
                                <option value="CD">Congo, Democratic Republic of the Congo</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CI">Cote D'Ivoire</option>
                                <option value="HR">Croatia</option>
                                <option value="CU">Cuba</option>
                                <option value="CW">Curacao</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="GQ">Equatorial Guinea</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FK">Falkland Islands (Malvinas)</option>
                                <option value="FO">Faroe Islands</option>
                                <option value="FJ">Fiji</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="GF">French Guiana</option>
                                <option value="PF">French Polynesia</option>
                                <option value="TF">French Southern Territories</option>
                                <option value="GA">Gabon</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="DE">Germany</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GU">Guam</option>
                                <option value="GT">Guatemala</option>
                                <option value="GG">Guernsey</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HM">Heard Island and Mcdonald Islands</option>
                                <option value="VA">Holy See (Vatican City State)</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IR">Iran, Islamic Republic of</option>
                                <option value="IQ">Iraq</option>
                                <option value="IE">Ireland</option>
                                <option value="IM">Isle of Man</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italy</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JE">Jersey</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="KP">Korea, Democratic People's Republic of</option>
                                <option value="KR">Korea, Republic of</option>
                                <option value="XK">Kosovo</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Lao People's Democratic Republic</option>
                                <option value="LV">Latvia</option>
                                <option value="LB">Lebanon</option>
                                <option value="LS">Lesotho</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libyan Arab Jamahiriya</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MO">Macao</option>
                                <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                                <option value="MG">Madagascar</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldives</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MH">Marshall Islands</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="YT">Mayotte</option>
                                <option value="MX">Mexico</option>
                                <option value="FM">Micronesia, Federated States of</option>
                                <option value="MD">Moldova, Republic of</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="MM">Myanmar</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="AN">Netherlands Antilles</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NU">Niue</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="MP">Northern Mariana Islands</option>
                                <option value="NO">Norway</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PW">Palau</option>
                                <option value="PS">Palestinian Territory, Occupied</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Reunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russian Federation</option>
                                <option value="RW">Rwanda</option>
                                <option value="BL">Saint Barthelemy</option>
                                <option value="SH">Saint Helena</option>
                                <option value="KN">Saint Kitts and Nevis</option>
                                <option value="LC">Saint Lucia</option>
                                <option value="MF">Saint Martin</option>
                                <option value="PM">Saint Pierre and Miquelon</option>
                                <option value="VC">Saint Vincent and the Grenadines</option>
                                <option value="WS">Samoa</option>
                                <option value="SM">San Marino</option>
                                <option value="ST">Sao Tome and Principe</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="RS">Serbia</option>
                                <option value="CS">Serbia and Montenegro</option>
                                <option value="SC">Seychelles</option>
                                <option value="SL">Sierra Leone</option>
                                <option value="SG">Singapore</option>
                                <option value="SX">Sint Maarten</option>
                                <option value="SK">Slovakia</option>
                                <option value="SI">Slovenia</option>
                                <option value="SB">Solomon Islands</option>
                                <option value="SO">Somalia</option>
                                <option value="ZA">South Africa</option>
                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                <option value="SS">South Sudan</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SD">Sudan</option>
                                <option value="SR">Suriname</option>
                                <option value="SJ">Svalbard and Jan Mayen</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="SY">Syrian Arab Republic</option>
                                <option value="TW">Taiwan, Province of China</option>
                                <option value="TJ">Tajikistan</option>
                                <option value="TZ">Tanzania, United Republic of</option>
                                <option value="TH">Thailand</option>
                                <option value="TL">Timor-Leste</option>
                                <option value="TG">Togo</option>
                                <option value="TK">Tokelau</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad and Tobago</option>
                                <option value="TN">Tunisia</option>
                                <option value="TR">Turkey</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks and Caicos Islands</option>
                                <option value="TV">Tuvalu</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraine</option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="GB">United Kingdom</option>
                                <option value="US">United States</option>
                                <option value="UM">United States Minor Outlying Islands</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VE">Venezuela</option>
                                <option value="VN">Viet Nam</option>
                                <option value="VG">Virgin Islands, British</option>
                                <option value="VI">Virgin Islands, U.s.</option>
                                <option value="WF">Wallis and Futuna</option>
                                <option value="EH">Western Sahara</option>
                                <option value="YE">Yemen</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="">State</label>
                        <div>
                            <input type="text" class="form-control" id="state">
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="city">City</label>
                        <div>
                            <input type="text" class="form-control" id="city">
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mt-4 form-group">
                        <label for="">Postcode</label>
                        <div>
                            <input type="number" class="form-control" id="postcode">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 justify-content-end" style="display:none;">
                <a class="btn btn-primary" style="border-radius:3vh;" id="next">NEXT</a>
            </div>
        </div>
    </form>
</div>
<script>
    var step = 1;
    var email_format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let options = {
        root: document.getElementById("#paragraph_div"),
        rootMargin: "0px",
        threshold: 0,
    };
    var observer = new IntersectionObserver(show_item, options);

    $(document).ready(()=>{
        var p = $("#membership_paragraph").text();
        var p_array = p.split("\n");
        if(p_array.length > 0){
            $("#membership_paragraph").empty();
            for(var i=0;i<p_array.length;i++){
                var span = "<span class='membership-paragraph' style='opacity:0.2;line-height:200px;transition-duration:1.5s;'>" + p_array[i] + "</span>\n";
                $("#membership_paragraph").append(span);
            }
        }

        // var p_span = $(".membership-paragraph");
        // if(p_span.length > 0){
        //     for(var i=0;i<p_span.length;i++){
        //         observer.observe(p_span[i]);
        //     }
        // }
        var el = $("#start_membership_process").children();
        for(var i=0; i<el.length;i++){
            observer.observe(el[i])
        }

        $("#first_name").on("input", (e) =>{
            if(e.target.value != ""){
                $("#first_name").removeClass("is-invalid");
                $(".first-name-error").remove();
            }
        })
        $("#last_name").on("input", (e) =>{
            if(e.target.value != ""){
                $("#last_name").removeClass("is-invalid");
                $(".last-name-error").remove();
            }
        })
        $("#email").on("input", (e) =>{
            if(e.target.value != ""){
                if(email_format.test(e.target.value)){
                    $("#email").removeClass("is-invalid");
                    $(".email-error").remove();
                }else{
                    $(".email-error").text("Email format invalid.");
                }
            }
        })
        $("#contact").on("input", (e) =>{
            if(e.target.value != ""){
                if(e.target.value.length < 10){
                    $(".contact-error").text("Contact number must contain minimum 10 digits.");
                    return false;
                }
                $("#contact").removeClass("is-invalid");
                $(".contact-error").remove();
            }
        })

        $("#next").on("click", ()=>{
            if(step == 1){
                if($("input[name=salutation]:checked").val() != undefined){
                    $(".salutation-div").hide();
                    $("#progress_bar").css("width", "10%");
                    $("#spinner").css("display", "flex");
                }else{
                    $("#salutation_star").show();
                    $(".salutation-validate").after("<div class='error-message salutation-error'>Salutation is required.</div>");
                    return false;
                }
                setTimeout(() => {
                    step = 2;
                    $("#spinner").css("display", "none");
                    $(".name-div").slideToggle();
                }, 500);
            }else if(step == 2){
                if($("#first_name").val() == ""){
                    $("#name_star").show();
                    if(!$("#first_name").hasClass("is-invalid")){
                        $("#first_name").addClass("is-invalid");
                    }
                    if($(".first-name-error").length == 0){
                        $("#first_name").after("<div class='error-message first-name-error'>First name is required.</div>");
                    }
                }
                if($("#last_name").val() == ""){
                    $("#name_star").show();
                    if(!$("#last_name").hasClass("is-invalid")){
                        $("#last_name").addClass("is-invalid");
                    }
                    if($(".last-name-error").length == 0){
                        $("#last_name").after("<div class='error-message last-name-error'>Last name is required.</div>");
                    }
                }

                if($("#first_name").val() == "" || $("#last_name").val() == ""){
                    return false;
                }

                $(".name-div").hide();
                $("#progress_bar").css("width", "20%");
                $("#spinner").css("display", "flex");

                setTimeout(() => {
                    step = 3;
                    $("#spinner").css("display", "none");
                    $(".email-div").slideToggle();
                }, 500);
            }else if(step == 3){
                if($("#email").val() == ""){
                    $("#email_star").show();
                    if(!$("#email").hasClass("is-invalid")){
                        $("#email").addClass("is-invalid");
                    }
                    if($(".email-error").length == 0){
                        $("#email").after("<div class='error-message email-error'>Email is required.</div>");
                    }
                }
                if(!email_format.test($("#email").val())){
                    $("#email_star").show();
                    if(!$("#email").hasClass("is-invalid")){
                        $("#email").addClass("is-invalid");
                    }
                    if($(".email-error").length == 0){
                        $("#email").after("<div class='error-message email-error'>Email format is invalid.</div>");
                    }
                }
                if($("#contact").val() == ""){
                    $("#email_star").show();
                    if(!$("#contact").hasClass("is-invalid")){
                        $("#contact").addClass("is-invalid");
                    }
                    if($(".contact-error").length == 0){
                        $("#contact").after("<div class='error-message contact-error'>Contact is required.</div>");
                    }
                }
                if($("#contact").val().length < 10){
                    $("#email_star").show();
                    if(!$("#contact").hasClass("is-invalid")){
                        $("#contact").addClass("is-invalid");
                    }
                    if($(".contact-error").length == 0){
                        $("#contact").after("<div class='error-message contact-error'>Contact number must contain minimum 10 digits.</div>");
                    }
                }
                if($("#email").val() == "" || 
                $("#contact").val() == "" || 
                $("#contact").val().length < 10 || 
                !email_format.test($("#email").val())){
                    return false;
                }

                $(".email-div").hide();
                $("#progress_bar").css("width", "40%");
                $("#spinner").css("display", "flex");

                setTimeout(() => {
                    step = 4;
                    $("#spinner").css("display", "none");
                    $(".religion-div").slideToggle();
                }, 1000);
            }else if(step == 4){
                if($("input[name=religion]:checked").val() != undefined){
                    $(".religion-div").hide();
                    if($("input[name=religion]:checked").val() == "christian"){
                        $("#progress_bar").css("width", "60%");
                    }else{
                        $("#progress_bar").css("width", "80%");
                    }
                    $("#spinner").css("display", "flex");
                }else{
                    $("#religion_star").show();
                    $(".religion-validate").after("<div class='error-message religion-error'>Religion is required.</div>");
                    return false;
                }

                setTimeout(() => {
                    if($("input[name=religion]:checked").val() == "christian"){
                        step = 5;
                        $(".attend-church-div").slideToggle();
                    }else{
                        step = 7;
                        $("#next").text("SUBMIT");
                        $(".extra-details-div").slideToggle();
                    }
                    $("#spinner").css("display", "none");
                }, 1500);
            }else if(step == 5){
                if($("input[name=is_attend_church]:checked").val() != undefined){
                    $(".attend-church-div").hide()
                    if($("input[name=is_attend_church]:checked").val() == 1){
                        $("#progress_bar").css("width", "70%");
                    }else{
                        $("#progress_bar").css("width", "80%");
                    }
                    $("#spinner").css("display", "flex");
                }else{
                    $("#attend_church_star").show();
                    $(".attend_church-validate").after("<div class='error-message attend-church-error'>This field is required.</div>");
                    return false;
                }

                setTimeout(() => {
                    if($("input[name=is_attend_church]:checked").val() == 1){
                        step = 6;
                        $(".church-div").slideToggle();
                    }else{
                        step = 7;
                        $(".extra-details-div").slideToggle();
                        $("#next").text("SUBMIT");
                    }

                    $("#spinner").css("display", "none");
                }, 500);
            }else if(step == 6){
                $(".church-div").hide();
                $("#spinner").css("display", "flex");
                $("#progress_bar").css("width", "80%");

                setTimeout(() => {
                    step = 7;
                    $(".extra-details-div").slideToggle();
                    $("#spinner").css("display", "none");
                    $("#next").text("SUBMIT");
                }, 1500);
            }else if(step == 7){
                $("#progress_bar").css("width", "100%");
                $(".extra-details-div").hide();
                $("#spinner").css("display", "flex");

                setTimeout(() => {
                    $("#spinner").css("display", "none");
                    success_response("Successfully registered!", true, "/register")
                }, 1500);
            }
        })
    })

    function start(){
        $("#start_membership_process").slideToggle()
        $("#spinner").css("display", "flex");
        $("#next").parent().css("display", "flex");
        setTimeout(()=>{
            $(".progress").slideToggle();
            $("#start_membership_process").remove();
            $(".salutation-div").slideToggle();
            $("#spinner").css("display", "none");
        }, 1500)
    }

    function show_item(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    if(entries[i].target.id == "membership_img" || entries[i].target.id == "membership_start"){
                        $(entries[i].target).css("transform", "translateY(0%)");
                        $(entries[i].target).css("opacity", "1");
                    }else if(entries[i].target.id == "membership_paragraph"){
                        var p_span = $(entries[i].target).children();
                        for(var i=0;i<p_span.length;i++){
                            $(p_span[i]).css("opacity", "1");
                            $(p_span[i]).css("line-height", "25px");
                        }
                    }
                }
            }
        }
    }
</script>
@include("include/footer")
