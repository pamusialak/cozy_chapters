<?php require 'inc/header.php'; ?>

  <body>
    <main class="container">
      <h1>Didn't find a book? Add yours!</h1> 
        <section class="form-row row justify-content-center">
          <!-- the add.php will execute our CREATE function -->
          <form method="post" action="add.php" class="form-horizontal col-md-6 col-md-offset-3">
            <!-- I am using the wrong input types so that we can test our php validation with no road blocks -->
            <p><input type="number" name="isbn" placeholder="ISBN" required></p>
            <p><input type="text" name="book_name" placeholder="Book's Name" required></p>
            <p><input type="text" name="authors_name" placeholder="Author's name" required></p>
            <p><input type="number" name="number_of_pages" placeholder="Pages" required></p>
            <p><input type="number" name="edition" placeholder="Edition"></p>
            <p><input type="text" name="publisher" placeholder="Publisher" required></p>
            <p><input type="text" name="original_language" placeholder="Language" required></p>
            <input type="hidden" id="date_added" name="date_added">
            <input class="btn btn-primary order" type="submit" name="Submit" value="Add">
            <input class="btn btn-dark reset" type="reset" value="Clear">
          </form>
        </section>
      </main>
  </body>

  <?php include 'inc/footer.php'; ?>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const today = new Date();
        const dateString = today.toISOString().split('T')[0]; 
        document.getElementById('date_added').value = dateString;
    });
  </script>
</html>
