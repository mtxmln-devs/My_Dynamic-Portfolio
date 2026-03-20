<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Test Page</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div style="padding: 40px; max-width: 800px; margin: 0 auto;">
        <h1>🎨 CSS Loading Test</h1>
        
        <div class="alert alert-success" style="margin: 20px 0;">
            ✅ If this box is GREEN with rounded corners, CSS is loading correctly!
        </div>
        
        <div class="alert alert-error" style="margin: 20px 0;">
            ⚠️ If this box is RED/PINK with rounded corners, CSS is loading correctly!
        </div>
        
        <h2>File Paths Check:</h2>
        <ul>
            <li><strong>Current File:</strong> <?php echo __FILE__; ?></li>
            <li><strong>CSS Path (Relative):</strong> admin_style.css</li>
            <li><strong>Current URL:</strong> <?php echo $_SERVER['REQUEST_URI']; ?></li>
            <li><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT']; ?></li>
        </ul>
        
        <h2>CSS File Check:</h2>
        <?php
        $css_file = __DIR__ . '/admin_style.css';
        if (file_exists($css_file)) {
            echo "<div class='alert alert-success'>✅ admin_style.css EXISTS in: " . $css_file . "</div>";
            echo "<p><strong>File Size:</strong> " . filesize($css_file) . " bytes</p>";
        } else {
            echo "<div class='alert alert-error'>❌ admin_style.css NOT FOUND in: " . $css_file . "</div>";
            echo "<p>Please make sure admin_style.css is in the same folder as this test file.</p>";
        }
        ?>
        
        <h2>Test Elements:</h2>
        
        <button class="btn btn-primary">Primary Button</button>
        <button class="btn btn-secondary">Secondary Button</button>
        <button class="btn btn-logout">Logout Button</button>
        
        <br><br>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                    <th>Column 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Data 1</td>
                    <td>Data 2</td>
                    <td>Data 3</td>
                </tr>
            </tbody>
        </table>
        
        <br>
        
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-info">
                <h3>25</h3>
                <p>Test Stat Card</p>
            </div>
        </div>
        
        <br>
        
        <h2>Next Steps:</h2>
        <ol>
            <li>If CSS is loading: <a href="login.php">Go to Login Page</a></li>
            <li>If CSS is NOT loading: Check the error message above</li>
            <li>After testing: <a href="dashboard.php">Go to Dashboard</a></li>
        </ol>
    </div>
</body>
</html>