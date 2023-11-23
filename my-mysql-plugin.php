<?php
/*
Plugin Name: My MySQL Plugin
Description: Display data from MySQL server.
Version: 1.0
Author: Valter Schmaltz
*/

// Enqueue scripts and styles
function enqueue_plugin_scripts() {
    wp_enqueue_style('mysql-plugin-style', plugin_dir_url(__FILE__) . 'style.css');
}

add_action('wp_enqueue_scripts', 'enqueue_plugin_scripts');

// Shortcode to display data
function display_mysql_data() {
    // Connect to the database (Replace with your actual database credentials)
    $db_host = 'your_db_host';
    $db_user = 'your_db_user';
    $db_password = 'your_db_password';
    $db_name = 'your_db_name';
    $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check for a successful connection
    if ($connection->connect_error) {
        return 'Error connecting to the database.';
    }

    // Fetch data from the mysql_table table
    $query = "SELECT * FROM mysql_table";
    $result = $connection->query($query);

    // Display data
    $output = '<div class="mysql-plugin">';
    $output .= '<h2>MySQL Data</h2>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '<p>' . esc_html($row['your_column']) . '</p>';
            // Add more columns as needed
        }
    } else {
        $output .= '<p>No data found.</p>';
    }

    $output .= '</div>';

    // Close the database connection
    $connection->close();

    return $output;
}

add_shortcode('mysql_data', 'display_translation_data');
