<footer>
    <div id="subscribe">
        <div class="container">
            <h1 class="uppercase">Subscribe Now</h1>
            <p>Join <?php echo $store_data->name; ?> and get all the latest news, trends and offers straight to your
                inbox</p>
            <?php flash('subscription_successful'); ?>
            <form id="subscribe-form" class="form-inline" method="post"
                action="<?php getLink('users/subscribeOther'); ?>">
                <div class="input-group">
                    <label for="subscribe-field"><i class="fas fa-envelope"></i></label>
                    <input type="email" id="subscribe-field" placeholder="Enter your email address" autocomplete="on"
                        name="email">
                </div>
                <button type="submit" class="uppercase p-2">SUBSCRIBE</button>
            </form>
        </div>
    </div>
    <div id="links">
        <div class="container">
            <div class="social-links">
                <div class="d-flex">
                    <img src="<?php getLink('img/' . $store_data->logo); ?>" width="65px" alt="logo">
                    <h1 class="uppercase">
                        <?php echo $store_data->name; ?>
                    </h1>
                </div>
                <div id="social-links" class="d-flex">
                    <?php if ($store_data->facebook_link !== '') { ?>
                    <a target="_blank" href="<?php echo $store_data->facebook_link; ?>"><i
                            class="fab fa-facebook-f"></i></a>
                    <?php } ?>
                    <?php if ($store_data->instagram_link !== '') { ?>
                    <a target="_blank" href="<?php echo $store_data->instagram_link; ?>"><i
                            class="fab fa-instagram"></i></a>
                    <?php } ?>
                    <?php if ($store_data->twitter_link !== '') { ?>
                    <a target="_blank" href="<?php echo $store_data->twitter_link; ?>"><i
                            class="fab fa-twitter"></i></a>
                    <?php } ?>
                    <?php if ($store_data->youtube_link !== '') { ?>
                    <a target="_blank" href="<?php echo $store_data->youtube_link; ?>"><i
                            class="fab fa-youtube"></i></a>
                    <?php } ?>
                    <?php if ($store_data->google_plus_link !== '') { ?>
                    <a target="_blank" href="<?php echo $store_data->google_plus_link; ?>"><i
                            class="fab fa-google-plus-g"></i></a>
                    <?php } ?>
                    <?php if ($store_data->vimeo_link !== '') { ?>
                    <a target="_blank" href="<?php echo $store_data->vimeo_link; ?>"><i class="fab fa-vimeo-v"></i></a>
                    <?php } ?>
                </div>
            </div>
            <div id="left-links">
                <h4 class="uppercase">About <?php echo $store_data->name; ?></h4>
                <ul>
                    <li><a href="<?php getLink('pages/page/about'); ?>">About Us</a></li>
                    <li><a href="<?php getLink('pages/page/company'); ?>">Company</a></li>
                    <li><a href="<?php getLink('pages/page/services'); ?>">Services</a></li>
                    <li><a href="<?php getLink('pages/page/careers'); ?>">Careers</a></li>
                    <li><a href="<?php getLink('pages/page/store locator'); ?>">Store Locator</a></li>
                </ul>
            </div>
            <div id="center-links">
                <h4 class="uppercase">My Account</h4>
                <ul>
                    <li><a href="<?php getLink('users/signin'); ?>">Login</a></li>
                    <li><a href="<?php getLink('users/account'); ?>">Account</a></li>
                    <li><a href="<?php getLink('users/order_history'); ?>">Order History</a></li>
                </ul>
            </div>
            <div id="right-links">
                <h4 class="uppercase">Customer Care</h4>
                <ul>
                    <li><a href="<?php getLink('pages/page/contact us'); ?>">Contact Us</a></li>
                    <li><a href="<?php getLink('pages/page/faq'); ?>">FAQ</a></li>
                    <li><a href="<?php getLink('pages/page/shipping policy'); ?>">Shipping Policy</a></li>
                    <li><a href="<?php getLink('pages/page/our policy'); ?>">Our Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="footer-bottom">
        <div class="container">
            &copy; <?php echo $store_data->name; ?> 2019.
        </div>
    </div>
</footer>
<script src="<?php getLink('js/dropdown.js'); ?>"></script>
<script src="<?php getLink('js/script.js'); ?>"></script>
</body>

</html>