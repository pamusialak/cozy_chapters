<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/books.png" type="image/x-icon"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Cozy Chapters - Bookish's social</title>
</head>

<body>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="form.php">Add a Book</a></li>
                <li><a href="#allbooks">All books</a></li>
                <li><a href="#store">Store</a></li>
            </ul>
        </nav>
    
        <header class="carousel">
            <img src="img/header-image1.png" alt="Books and cozy reading space" class="active">
            <img src="img/header-image2.png" alt="Reading nook with books">
            <img src="img/header-image3.png" alt="Bookshelf with various books">
        </header>
    
        <main>
            <h1>Welcome to Cozy Chapters!</h1>
            <h2>Where Your Bookish Dreams Come True!</h2>
            
            <p>Looking for new reading recommendations?<br>
                Want to join a book club?<br>
                Discuss your favorite books with fellow readers?<br>
                Find great deals on books or participate in exciting giveaways?<br>
                You're in the right place!</p>
            
            <p>Explore Cozy Chapters and let your bookish adventures begin. Happy reading!</p>
        </main>
    
        <footer>
            <p>&copy; 2024 Cozy Chapters. All rights reserved.</p>
        </footer>
    
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
    </body>
    </html>
    
        <footer>
            <p>&copy; 2024 Cozy Chapters. All rights reserved.</p>
        </footer>
    
    
</body>
</html>