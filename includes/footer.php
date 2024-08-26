    <!-- Footer Section -->
    <section class="container footer">
        <div class="sectionContent grid">
 
         <div class="footerIntro">
         <div class="logoDiv">
             <a href="#" class="logo">
                FOODIE
             </a>
         </div>
         <p>
             579 8th Avenue Canadian Highway, 3443. <br>
             Canada.
             
             <span class="phone">+444 789 000 00</span>
         </p>
 
         <div class="socials flex">
            <a href="https://www.facebook.com/" target="_blank">
                <i class='bx bxl-facebook-circle icon'></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank">
                <i class='bx bxl-instagram-alt icon' ></i>
            </a>
            <a href="https://x.com/" target="blank">
                <i class='bx bxl-twitter icon' ></i>
            </a>
            <a href="https://www.youtube.com/" target="_blank">
                <i class='bx bxl-youtube icon' ></i>
            </a>

         </div>
         </div>
 
         <div class="timing">
         <h3>Opening Hours</h3>
         <p>Monday - Friday 8AM - 11PM</p>
         <p>Saturday - Sunday 8AM - 6PM</p>
         
         </div>
 
         <div class="quickLinks">
             <h3>Quick Link</h3>
             <li class="navItem">
                 <a href="<?=ROOT_URL?>" class="navLink">Home</a>
             </li>
 
             <li class="navItem">
                 <a href="menu" class="navLink">Menu</a>
             </li>
             <li class="navItem">
                 <a href="login" class="navLink">Administrator</a>
             </li>
 
         </div>
        </div>
    </section>
    <!-- Footer Section Ends -->

    <!-- Copyright Div -->
    <section class="copyrightDiv">
        <p>ALL RIGHT RESERVED | NEBOJSA <script>document.write(new Date().getFullYear())</script></p>
    </section>
    <!-- Copyright Div Ends -->
 
 
    <!-- Link to swiper JS -->
    <script src="<?=ROOT_URL?>public/js/swiper-bundle.min.js"></script>
    <!-- Link to JS -->
    <script src="<?=ROOT_URL?>public/js/main.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS only when the page is loaded or refreshed
        AOS.init();
        });
    </script>
     
 </body>
 </html>  
 