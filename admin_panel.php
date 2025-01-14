<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get inputs from the form
    $filename = trim($_POST['filename']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Validate inputs
    if (empty($filename) || empty($title) || empty($content)) {
        echo "All fields are required!";
    } else {
        // Ensure the filename ends with .html
        if (!str_ends_with($filename, '.html')) {
            $filename .= '.html';
        }

        // Directory for news files
        $newsDir = __DIR__ . '/news/';
        if (!is_dir($newsDir)) {
            mkdir($newsDir, 0777, true); // Create directory if it doesn't exist
        }

        // Full path for the new file
        $filePath = $newsDir . $filename;

        // Prepare HTML content
        $htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NewsDaily - {$title}</title>
  <link rel="stylesheet" href="news.css">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
  <nav>
    <div class="nav-container">
      <span class="logo">NewsDaily</span>
    </div>
  </nav>

  <main>
    <header class="article-header">
      <h1>{$title}</h1>
      
      <div class="article-meta">
        <div class="meta-item">
          <i data-lucide="user"></i>
          <span>By Sarah Johnson</span>
        </div>
        <div class="meta-item">
          <i data-lucide="clock"></i>
          <time>March 15, 2024</time>
        </div>
        <span>8 min read</span>
      </div>

      <div class="social-actions">
        <button>
          <i data-lucide="share-2"></i>
          Share
        </button>
        <button>
          <i data-lucide="bookmark"></i>
          Save
        </button>
        <button>
          <i data-lucide="message-square"></i>
          Comments
        </button>
      </div>
    </header>

    <figure class="featured-image">
      <img
        src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&q=80"
        alt="Solar panels under blue sky"
      />
      <figcaption>
        Modern solar panel installation in California. Photo: Unsplash
      </figcaption>
    </figure>

    <article>
      <p class="lead">
        {$content}
      </p>
    </article>
  </main>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>
</body>
</html>
HTML;

        // Write content to file
        if (file_put_contents($filePath, $htmlContent)) {
            echo "File created successfully: <a href='news/{$filename}' target='_blank'>View File</a>";
        } else {
            echo "Error creating file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <form method="POST">
        <label for="filename">Filename (e.g., mynews.html):</label><br>
        <input type="text" id="filename" name="filename" required><br><br>

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="10" cols="30" required></textarea><br><br>

        <button type="submit">Create HTML File</button>
    </form>
</body>
</html>