<?php
session_start();
$logged_in = isset($_SESSION['user']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>TutorLink-Lite</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>TutorLink-Lite</h1>

    <nav>
      <a href="index.php">Home</a> |
      <a href="php/search.php">Search Tutors</a> |

      <?php if (!$logged_in): ?>
        <a href="php/signup.php">Sign up</a> |
        <a href="php/login.php">Log in</a>
      <?php else: ?>
        <?php if ($_SESSION['user']['role'] == 'tutor'): ?>
          <a href="php/dashboard_tutor.php">Tutor Dashboard</a> |
        <?php else: ?>
          <a href="php/dashboard_student.php">Student Dashboard</a> |
        <?php endif; ?>
        <a href="php/logout.php">Logout</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <section class="hero">
      <h2>Find trusted tutors quickly — TutorLink-Lite</h2>
      <p>
        Search by subject, city, price and teaching mode.
        Watch preview videos and compare tutors side-by-side.
      </p>

      <div class="search-inline">
        <input
          id="quickSearch"
          placeholder="Type subject or city to preview (client-side)"
        />
        <button id="goSearch" onclick="location.href='php/search.php'">
          Search
        </button>
      </div>

      <div id="previewList" class="preview-list"></div>
    </section>

    <section>
      <h3>How it works</h3>
      <ol>
        <li>Create an account (student or tutor)</li>
        <li>Search tutors and compare up to 3 results</li>
        <li>Book a session and manage bookings in dashboard</li>
      </ol>
    </section>
  </main>

  <footer>
    <p>Contact: tutorlink-lite@example.com</p>
  </footer>

  <script src="js/main.js"></script>
</body>
</html>
