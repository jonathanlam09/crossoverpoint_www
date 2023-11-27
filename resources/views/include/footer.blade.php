
<footer style="background-color: black;">
    <section id="contact_us">
        <div class="container pt-5 pb-5" style="color: white;">
            <div class="row">
                <div class="col-lg-6 col-12 mb-5 p-5">
                    <h6 style="font-weight: 700; font-size: 18px; margin: 0;">Crossover Point</h6>
                    <p class="mt-3 mb-2" style="margin:0">32A, Jalan Aman Tiara 8, Telok Panglima Garang, Selangor 42500</p>
                    <a class="mt-3 text-white" style="cursor:pointer;text-decoration:none;" href="mailto:crossoverpointchurch@gmail.com">crossoverpointchurch@gmail.com</a>
                    <div class="mt-3 row">
                        <div class="col-2">
                            <a class="text-white" href="https://www.facebook.com/crossoverpointchurch" target="_blank">
                                <i class="fa fa-facebook-f" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-2">
                            <a class="text-white" href="https://www.instagram.com/crossoverpoint/" target="_blank">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-2">
                            <a class="text-white" target="_blank" href="https://wa.me/60123861850?text=I%20would%20like%20to%20ask%20about%20Kota%20Kemuning%20Assembly%20Of%20God">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-2">
                            <a class="text-white" href="mailto:crossoverpointchurch@gmail.com">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
                <div class="col-lg-6 col-12 p-5">
                    <form>
                        <div>
                            <h6 style="font-weight: 700; font-size: 18px; margin: 0;">Enquiries</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3">
                                <label for="">First Name</label>
                                <input name="first_name" type="text" class="form-control">
                            </div>
                            <div class="col-6 mt-3">
                                <label for="">Last Name</label>
                                <input name="last_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3">
                                <label for="">Contact</label>
                                <input name="contact" type="text" class="form-control">
                            </div>
                            <div class="col-6 mt-3">
                                <label for="">Email</label>
                                <input name="email" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="">Type of Enquiries</label>
                                <select name="type_of_enquiries" class="form-control">
                                    <option value="">Select your enquiries</option>
                                    <option value="1">Prayer request</option>
                                    <option value="2">Shelter</option>
                                    <option value="3">Serving</option>
                                    <option value="4">Full time ministry</option>
                                    <option value="5">Discipleship</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="">Remarks</label>
                                <textarea class="form-control" style="resize: none;" name="enquiries" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="mt-3" style="display: flex; justify-content: flex-end;">
                            <a class="btn btn-default text-white" style="background-color:cornflowerblue;border-radius:2vh;" href="">Submit</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</footer>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
<script src="<?php echo url("assets/js/validation.js?ver=" . time())?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
crossorigin="anonymous"></script>
<script>
    const address = window.location.origin + "/";
    const portal_address = "https://admin.crossoverpoint.org.my/";
    const apiHeader = { headers: { "Content-Type": "multipart/form-data"} };

    $(document).ready(()=>{
        $("#dt_search").on("input", ()=>{
            var type = $("#type").val()
            var count = $("#count").val()
            var page = $(".page.active-page").text()
            var value = $("#dt_search").val()
            
            if(type == "event"){
                get_events(0, count, value)
            }else if(type == "sermon"){
                get_sermons(0, count, value)
            }
        })
    })

    function setup(total){
        var count = parseInt($("#count").val())
        total = Math.ceil(total/count);
        if(total > 5){
            for(var i=1;i<=total;i++){
                if(i == 2){
                    var page = "<div class='more_page' id='more_page_1' style='display:none;'>...</div>";
                    $("#page_" + i).before(page);
                    $(".pagination").append(page)
                }else if(i == total){
                    var page = "<div class='more_page' id='more_page_2'>...</div>";
                    $("#page_" + i).before(page);
                    $(".pagination").append(page)
                }
                
                if(i > 3 && i < total){
                    var page = "<div class='page' onclick='paginate(" + i + ", " + total +")' id='page_" + i + "' style='display:none;'>" + i + "</div>";
                    $(".pagination").append(page)
                }else{
                    if(i == 1){
                        var page = "<div class='active-page page' onclick='paginate(" + i + ", " + total +")' id='page_" + i + "'>" + i + "</div>";
                        $(".pagination").append(page)
                    }else{
                        var page = "<div class='page' onclick='paginate(" + i + ", " + total +")' id='page_" + i + "'>" + i + "</div>";
                        $(".pagination").append(page)
                    }
                }
            }
        }else{
            for(var i=1;i<=total;i++){
                if(i == 1){
                    var page = "<div class='active-page page' onclick='paginate(" + i + ", " + total +")' id='page_" + i + "'>" + i + "</div>";
                    $(".pagination").append(page)
                }else{
                    var page = "<div class='page' onclick='paginate(" + i + ", " + total +")' id='page_" + i + "'>" + i + "</div>";
                    $(".pagination").append(page)
                }
            }
        }
    }

    function paginate(index, total_pages){
        var count = $("#count").val();
        var type = $("#type").val();
        $("html, body").animate({scrollTop : 500}, 500);

        if(total_pages > 5){
            if(index < 4){
                for(var i=1;i<=total_pages;i++){
                    if(i < 4 || i == total_pages){
                        $("#page_" + i).css("display", "")
                    }else{
                        $("#page_" + i).css("display", "none")
                    }

                    if(index == 3){
                        $("#page_" + 4).css("display", "")
                    }
                }
                $("#more_page_1").css("display", "none")
                $("#more_page_2").css("display", "")
            }else if(index >= 4 && index < total_pages-2){
                for(var i=1;i<=total_pages;i++){
                    if(i == 1 || i == total_pages || i == index || i == index+1 || i == index-1){
                        $("#page_" + i).css("display", "")
                    }else{
                        $("#page_" + i).css("display", "none")
                    }
                }
                $("#more_page_1").css("display", "")
                $("#more_page_2").css("display", "")
            }
            else if(index >= total_pages-2){
                for(var i=1;i<=total_pages;i++){
                    if(i == 1 || i > total_pages-3){
                        $("#page_" + i).css("display", "")
                    }else{
                        $("#page_" + i).css("display", "none")
                    }
                }
                if(index == total_pages-2){
                    $("#page_" + (total_pages-3)).css("display", "")
                }
                $("#more_page_2").css("display", "none")
                $("#more_page_1").css("display", "")
            }
        }

        for(var i=1;i<=total_pages;i++){
            if(i != index){
                $("#page_" + i).removeClass("active-page")
            }
            $("#page_" + index).addClass("active-page")
        }

        if(type == "event"){
            $("#event_row").empty()
            get_events((index*count)-count, count)
        }
        else if(type == "sermon"){
            $("#sermon_row").empty()
            get_sermons((index*count)-count, count)
        }
    }

    function success_response(data, redirect = false, redirect_page) {
        if (redirect) {
            Swal.fire({
                title: "Success!",
                icon: "success",
                text: data,
                button: 'OK',
            }).then((result) => {
                window.location.href = address + redirect_page;
            })
        } else {
            Swal.fire({
                title: "Success!",
                icon: "success",
                text: data,
                button: 'OK',
            })
        }
    }

    function warning_response(data, redirect = false, redirect_page) {
        if (redirect) {
            if (data != "checking") {
                Swal.fire({
                    title: "Warning!",
                    icon: "warning",
                    text: data,
                    button: 'OK',
                }).then((result) => {
                    window.location.href = address + redirect_page;
                })
            }
        } else {
            if (data != "warning") {
                Swal.fire({
                    title: "Warning!",
                    icon: "warning",
                    text: data,
                    button: 'OK',
                })
            }
        }
    }

    function error_response() {
        Swal.fire({
            title: "Error!",
            icon: "error",
            text: 'Something Error !',
            button: 'OK',
        })
    }
</script>