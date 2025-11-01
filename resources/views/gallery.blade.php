@include('include/header')
<style>
    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .gallery-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .gallery-topic-title {
        font-weight: 400;
        font-size: 2rem;
        margin-bottom: 3rem;
        color: #333;
    }

    .date-header {
        font-weight: 300;
        font-size: 1.5rem;
        margin: 3rem 0 2rem;
        color: #666;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .date-header.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .gallery-item {
        aspect-ratio: 1;
        overflow: hidden;
        border-radius: 4px;
        cursor: pointer;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .gallery-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }

    .no-gallery {
        text-align: center;
        color: #999;
        padding: 3rem 0;
        font-size: 1rem;
    }

    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .lightbox.active {
        opacity: 1;
        pointer-events: auto;
    }

    .lightbox-close {
        position: fixed;
        top: 2rem;
        right: 2rem;
        width: 40px;
        height: 40px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 4px;
        background: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 10000;
    }

    .lightbox-close:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .lightbox-image {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .gallery-container {
            padding: 2rem 1rem;
        }

        .gallery-topic-title {
            font-size: 1.5rem;
        }

        .date-header {
            font-size: 1.25rem;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .lightbox-close {
            top: 1rem;
            right: 1rem;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center"><?php echo $channel == "ENG" ? "GALLERY" : "画廊"?></h1>
    </div>
</div>

<div class="gallery-container">
    <h2 class="gallery-topic-title"><?php echo $topic->name ?></h2>
    
    <?php if(isset($topic->media) && count($topic->media) > 0): ?>
        <?php
            $currDate = null;
            $dateGroup = [];
            
            // Group media by date
            foreach($topic->media as $media) {
                $date = date("F Y", strtotime($media->date));
                if (!isset($dateGroup[$date])) {
                    $dateGroup[$date] = [];
                }
                $dateGroup[$date][] = $media;
            }
        ?>
        
        <?php foreach($dateGroup as $date => $mediaItems): ?>
            <h3 class="date-header"><?php echo $date ?></h3>
            <div class="gallery-grid">
                <?php foreach($mediaItems as $media): ?>
                    <div class="gallery-item" onclick="show_image('<?php echo $media->path?>')">
                        <img 
                            class="gallery-image" 
                            src="<?php echo ADMIN_PORTAL . $media->path?>" 
                            alt="Gallery image"
                            loading="lazy"
                        />
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-gallery"><?php echo $channel == "ENG" ? "No gallery at the moment." : "目前没有画廊。"?></p>
    <?php endif; ?>
</div>

<div class="lightbox" id="lightbox">
    <button class="lightbox-close" onclick="close_image()">
        <i class="fas fa-times"></i>
    </button>
    <img id="lightbox_image" class="lightbox-image" loading="lazy">
</div>

@include('include/footer')

<script>
    $(document).ready(() => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Add a small stagger delay
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, index * 50);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        // Observe date headers
        const dateHeaders = document.querySelectorAll('.date-header');
        dateHeaders.forEach(header => observer.observe(header));

        // Observe gallery items
        const galleryItems = document.querySelectorAll('.gallery-item');
        galleryItems.forEach(item => observer.observe(item));
    });

    function show_image(path) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox_image');
        
        lightboxImage.src = portal_address + path;
        lightbox.classList.add('active');
        
        // Prevent body scroll when lightbox is open
        document.body.style.overflow = 'hidden';
    }

    function close_image() {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox_image');
        
        lightbox.classList.remove('active');
        
        // Re-enable body scroll
        document.body.style.overflow = '';
        
        // Clear image after transition
        setTimeout(() => {
            lightboxImage.src = '';
        }, 300);
    }

    // Close lightbox on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            close_image();
        }
    });

    // Close lightbox when clicking outside image
    document.getElementById('lightbox').addEventListener('click', (e) => {
        if (e.target.id === 'lightbox') {
            close_image();
        }
    });
</script>