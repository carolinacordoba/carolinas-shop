<?php
function Footer()
{
    ?>
    <footer
        style="background-color: #F8F4F0; color: #333; padding: 60px 0 0; border-top: 1px; font-family: 'Roboto', sans-serif;">
        <div class="container text-center text-md-start">
            <div class="row">
                <!-- Footer left side -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="text-uppercase"
                        style="color: #333; font-weight: 600; margin-bottom: 20px; letter-spacing: 1px; font-size: 1.1rem;">
                        ABOUT LUXÉ</h5>
                    <p style="color: #333; line-height: 1.8; font-size: 1rem; width: 330px;">Where luxury meets effortless
                        beauty. Explore
                        our exclusive range of beauty products made to enhance your natural glow.</p>
                </div>
                <!-- Footer middle section -->
                <div class="col-md-4 mb-4 mb-md-0" style="padding-bottom: 40px;">
                    <h5 class="text-uppercase"
                        style="color: #333; font-weight: 600; margin-bottom: 20px; letter-spacing: 1px; font-size: 1.1rem;">
                        SUPPORT</h5>
                    <ul class="list-unstyled d-flex justify-content-center justify-content-md-start" style="gap: 20px;">
                        <li><a href=" #"
                                style="color: #333; text-decoration: none; font-size: 1rem; transition: color 0.3s; transform 0.3s;">Shop</a>
                        </li>
                        <li><a href="#"
                                style="color: #333; text-decoration: none; font-size: 1rem; transition: color 0.3s; transform 0.3s;">Contact</a>
                        </li>
                        <li><a href="#"
                                style="color: #333; text-decoration: none; font-size: 1rem; transition: color 0.3s; transform 0.3s;">FAQ</a>
                        </li>
                    </ul>
                </div>
                <!-- Footer right side -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="text-uppercase"
                        style="color: #333; font-weight: 600; margin-bottom: 20px; letter-spacing: 1px; font-size: 1.1rem;">
                        SOCIALS</h5>
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <a href="https://www.instagram.com" class="social-icon" target="_blank"
                            style="font-size: 26px; margin: 0 20px;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com" class="social-icon" target="_blank"
                            style="font-size: 26px; margin: 0 20px;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com" class="social-icon" target="_blank"
                            style="font-size: 26px; margin: 0 20px;">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://www.pinterest.com" class="social-icon" target="_blank"
                            style="font-size: 26px; margin: 0 20px;">
                            <i class="bi bi-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center py-3 "
            style="background-color: #333; color: #F8F4F0; font-size: 0.9rem; letter-spacing: 0.5px; ">
            <p class="mb-0">&copy; 2025 Luxé Beauty. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Hover effect on social media icons -->
    <style>
        .social-icon:hover {
            color: #B76E79;
            transition: color 0.3s ease, transform 0.2s ease;
            transform: translateY(-5px);
        }

        .social-icon {
            color: #333;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        footer a {
            text-decoration: none;
        }
    </style>
    <?php
}
?>