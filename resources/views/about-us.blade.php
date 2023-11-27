@include("include/header")
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>ABOUT US</h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center" style="border:1px solid;">
        <div class="d-flex" style="max-width:800px;position:relative;">
            <div style="position:absolute;top:0%;left:0%;">
                <img style="width:100%;" src="<?php echo url("assets/img/banner.png")?>" alt="">
            </div>
            <div style="position:absolute;top:0%;left:100%;">
                <img style="width:100%;" src="<?php echo url("assets/img/banner.png")?>" alt="">
            </div>
        </div>
        {{-- <div style="max-width: 800px;">
            <img style="width:100%;" src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div> --}}
    </div>
    <h4 class="mt-5">Our Pastor</h4>
    <p>Pastor Ian Wong is Crossover Point's senior pastor. 
        Pastor Ian's origin is in Sibu, Sarawak, East Malaysia. After receiving a calling from God,
    Pastor Ian moved to West Malaysia to shepherd the members of Crossover Point.</p>
</div>
<script>
</script>
@include("include/footer")
