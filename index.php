<?php include './inc/header.php'; ?>

<body>

    <div class="carousel">
        <img src="img/header-image1.png" alt="Books and cozy reading space" class="active">
        <img src="img/header-image2.png" alt="Reading nook with books">
        <img src="img/header-image3.png" alt="Bookshelf with various books">
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel img');
        const totalSlides = slides.length;
    
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }
    
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }
    
        setInterval(nextSlide, 3000);
    </script>

    <main>
        <h1>Welcome to Cozy Chapters!</h1>
        <h2>Where Your Bookish Dreams Come True!</h2>
                
        <p>Looking for new reading recommendations?<br>
            Want to join a book club?<br>
            Discuss your favorite books with fellow readers?<br>
            Find great deals on books or participate in exciting giveaways?<br>
            You're in the right place!</p>
                
        <p>Explore Cozy Chapters and let your bookish adventures begin. Happy reading!</p>
    

        <section class="form-row row">
        <div class="col-sm-12 col-md-6 col-lg-6">
        <h3>Don't have an account, then sign up below!</h3>
        <form method="post" action="save-admin.php">
          
        	<p><input class="form-control" name="first_name" type="text" placeholder="First Name" required/></p>
        	<p><input class="form-control" name="last_name" type="text" placeholder="Last Name" required /></p>
        	<p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
        	<p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
        	<p><input class="form-control" name="confirm" type="password" placeholder="Confirm Password" required /></p>
          <input class="btn btn-light" type="submit" name="submit" value="Register" />
        </form>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6">
        <h3>Already have an account, then sign in below!</h3>
        <form method="post" action="signin.php">
        	<p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
        	<p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
          <input class="btn btn-light" type="submit" value="Login" />
        </form>
      </div>
    </section>

</main>
</body>

<?php require 'inc/footer.php'; ?>