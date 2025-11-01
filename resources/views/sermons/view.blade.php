@include("include/header")
<?php
    $title = isset($sermon->title) ? $sermon->title : "-";
    $description = isset($sermon->description) ? $sermon->description : "-";
    $date = date("jS F Y", strtotime($sermon->date)) . " 10:00:00 AM";
    $image = isset($sermon->image) ? IMAGE_PATH . "sermon/" . $sermon->image : url("assets/img/banner.png");
?>
<style>
    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .sermon-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .sermon-image-wrapper {
        margin-bottom: 3rem;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .sermon-image-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .sermon-image {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .sermon-info {
        margin-bottom: 3rem;
    }

    .info-row {
        display: flex;
        padding: 1.5rem 0;
        border-bottom: 1px solid #f0f0f0;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .info-row.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 400;
        color: #666;
        min-width: 150px;
        flex-shrink: 0;
    }

    .info-value {
        color: #333;
        line-height: 1.6;
    }

    .info-value a {
        color: #333;
        text-decoration: underline;
        transition: color 0.3s ease;
    }

    .info-value a:hover {
        color: #000;
    }

    .back-button {
        display: inline-block;
        background: none;
        border: 1px solid #e0e0e0;
        color: #333;
        padding: 0.75rem 2rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 2rem;
    }

    .back-button:hover {
        border-color: #999;
        color: #000;
        text-decoration: none;
    }

    .button-wrapper {
        text-align: right;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .button-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .sermon-detail-container {
            padding: 2rem 1rem;
        }

        .info-row {
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-label {
            min-width: unset;
        }

        .button-wrapper {
            text-align: center;
        }

        .back-button {
            width: 100%;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center"><?php echo $channel == "ENG" ? "SERMONS" : "讲道"?></h1>
    </div>
</div>

<div class="sermon-detail-container">
    <div class="sermon-image-wrapper">
        <img src="<?php echo $image;?>" alt="<?php echo $title;?>" class="sermon-image">
    </div>

    <div class="sermon-info">
        <div class="info-row">
            <div class="info-label"><?php echo $channel == "ENG" ? "Title" : "标题"?></div>
            <div class="info-value"><?php echo $title?></div>
        </div>

        <div class="info-row">
            <div class="info-label"><?php echo $channel == "ENG" ? "Description" : "描述"?></div>
            <div class="info-value"><?php echo $description?></div>
        </div>

        <div class="info-row">
            <div class="info-label"><?php echo $channel == "ENG" ? "Date" : "日期"?></div>
            <div class="info-value"><?php echo $date?></div>
        </div>

        <div class="info-row">
            <div class="info-label"><?php echo $channel == "ENG" ? "Speaker" : "讲员"?></div>
            <div class="info-value">
                <?php
                    if($sermon->is_guest == 1){
                        echo $sermon->speaker_name ? $sermon->speaker_name . ($channel == "ENG" ? " (Guest)" : " (宾)") : "-";
                    }else{
                        echo $sermon->speaker ? $sermon->speaker->getFullname() : "-";
                    }
                ?>
            </div>
        </div>

        <?php if(isset($sermon->broadcast_live) && !empty($sermon->broadcast_live)){ ?>
        <div class="info-row">
            <div class="info-label"><?php echo $channel == "ENG" ? "Broadcast link" : "广播网址"?></div>
            <div class="info-value">
                <a href="<?php echo $sermon->broadcast_live?>" target="_blank"><?php echo $sermon->broadcast_live?></a>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="button-wrapper">
        <a onclick="history.back()" class="back-button"><?php echo $channel == "ENG" ? "Back" : "返回"?></a>
    </div>
</div>

@include("include/footer")

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        // Observe image
        const imageWrapper = document.querySelector('.sermon-image-wrapper');
        if(imageWrapper) observer.observe(imageWrapper);

        // Observe info rows
        const infoRows = document.querySelectorAll('.info-row');
        infoRows.forEach((row, index) => {
            row.style.transitionDelay = `${index * 0.1}s`;
            observer.observe(row);
        });

        // Observe button
        const buttonWrapper = document.querySelector('.button-wrapper');
        if(buttonWrapper) {
            buttonWrapper.style.transitionDelay = `${infoRows.length * 0.1}s`;
            observer.observe(buttonWrapper);
        }
    });
</script>