<?php
// Define the path to the directory
$directory = 'hitlist/';

// Check if the directory exists
if (is_dir($directory)) {
    // Open the directory
    if ($dh = opendir($directory)) {
        echo "<h2>Files in $directory</h2>";
        echo "<ul>";
        
        // Loop through the directory and list files
        while (($file = readdir($dh)) !== false) {
            // Skip "." and ".." entries
            if ($file != "." && $file != "..") {
                echo "<li>$file</li>";
            }
        }
        
        echo "</ul>";
        closedir($dh);  // Close the directory
    }
} else {
    echo "Directory does not exist!";
}
?>