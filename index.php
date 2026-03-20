<?php
require_once 'db_connect.php';

// Fetch personal info
$personal_info_query = "SELECT * FROM personal_info LIMIT 1";
$personal_info_result = $conn->query($personal_info_query);
$personal_info = $personal_info_result->fetch_assoc();

// Fetch skills grouped by category
$skills_query = "SELECT * FROM skills ORDER BY category, proficiency DESC";
$skills_result = $conn->query($skills_query);

// Group skills by category for display
$skills_by_category = [];
while ($skill = $skills_result->fetch_assoc()) {
    $category = $skill['category'] ?: 'Other';
    if (!isset($skills_by_category[$category])) {
        $skills_by_category[$category] = [];
    }
    $skills_by_category[$category][] = $skill;
}

// Fetch experience/education
$experience_query = "SELECT * FROM experience ORDER BY start_date ASC";
$experience_result = $conn->query($experience_query);

// Fetch projects
$projects_query = "SELECT * FROM projects ORDER BY start_date DESC";
$projects_result = $conn->query($projects_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $personal_info ? htmlspecialchars($personal_info['full_name']) : 'Portfolio'; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <div class="logo">Portfolio</div>
            <ul class="nav-links">
                <li><a href="#about" class="active">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <section id="about">
        <div class="about-container">
            <div class="about-content">
                <h2>Hi there! I'm <?php echo $personal_info ? htmlspecialchars($personal_info['full_name']) : 'Mark Laurence Taway'; ?></h2>
                <h1>Full Stack  </h1>
                <div class="role">Developer</div>
                <p><?php echo $personal_info ? nl2br(htmlspecialchars($personal_info['bio'])) : 'A passionate full-stack developer specializing in modern web technologies, I craft innovative digital solutions by blending back-end logic with front-end aesthetics to solve complex problems with clean, efficient code.'; ?></p>
                <div class="cta-buttons">
                    <a href="#projects" class="btn btn-primary">View my Works</a>
                    <a href="#contact" class="btn btn-secondary">Get in Touch</a>
                </div>
            </div>
            <div class="about-image">
                <img src="<?php echo $personal_info && $personal_info['profile_image'] ? htmlspecialchars($personal_info['profile_image']) : 'pik.png'; ?>" alt="<?php echo $personal_info ? htmlspecialchars($personal_info['full_name']) : 'Profile'; ?>">
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills">
        <div class="section-header">
            <h2>Skills & Technologies</h2>
            <p>My technical expertise and proficiency levels</p>
        </div>
        <div class="skills-container">
            <?php if (!empty($skills_by_category)): ?>
                <?php foreach ($skills_by_category as $category => $skills): ?>
                    <div>
                        <?php foreach ($skills as $skill): ?>
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span class="skill-name"><?php echo htmlspecialchars($skill['skill_name']); ?></span>
                                    <span class="skill-percentage"><?php echo $skill['proficiency']; ?>%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-progress" data-progress="<?php echo $skill['proficiency']; ?>"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback to default skills if none in database -->
                <div>
                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">HTML</span>
                            <span class="skill-percentage">92%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" data-progress="92"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">JavaScript</span>
                            <span class="skill-percentage">83%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" data-progress="83"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">CSS</span>
                            <span class="skill-percentage">88%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" data-progress="88"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education">
        <div class="section-header">
            <h2>Education & Experience</h2>
            <p>My academic and professional journey</p>
        </div>
        <div class="timeline">
            <?php if ($experience_result->num_rows > 0): ?>
                <?php while ($exp = $experience_result->fetch_assoc()): ?>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h3><?php echo htmlspecialchars($exp['title']); ?></h3>
                            <h4><?php echo htmlspecialchars($exp['company_institution']); ?><?php echo $exp['location'] ? ' (' . htmlspecialchars($exp['location']) . ')' : ''; ?></h4>
                            <div class="timeline-date">
                                <?php 
                                    echo date('Y', strtotime($exp['start_date']));
                                    echo $exp['end_date'] ? ' - ' . date('Y', strtotime($exp['end_date'])) : ' - Present';
                                ?>
                            </div>
                            <?php if ($exp['description']): ?>
                                <p><?php echo nl2br(htmlspecialchars($exp['description'])); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Fallback to default education if none in database -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>College Years</h3>
                        <h4>Camarines Sur Polytechnic Colleges: CSPC (Nabua, Camarines Sur)</h4>
                        <div class="timeline-date">2022 - Present</div>
                        <p>Still learning and growing. Progress matters.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects">
        <div class="section-header">
            <h2>Featured Projects</h2>
            <p>A selection of my recent works showcasing diverse technical capabilities</p>
        </div>
        <div class="projects-grid">
            <?php if ($projects_result->num_rows > 0): ?>
                <?php while ($project = $projects_result->fetch_assoc()): ?>
                    <div class="project-card">
                        <h3><?php echo htmlspecialchars($project['project_name']); ?></h3>
                        <?php if ($project['description']): ?>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                        <?php endif; ?>
                        <?php if ($project['technologies']): ?>
                            <div class="tech-tags">
                                <?php 
                                $tech_array = explode(',', $project['technologies']);
                                foreach ($tech_array as $tech): 
                                    $tech = trim($tech);
                                ?>
                                    <span class="tech-tag"><?php echo htmlspecialchars($tech); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($project['project_url']): ?>
                            <a href="<?php echo htmlspecialchars($project['project_url']); ?>" target="_blank" class="project-link">View my Work</a>
                        <?php else: ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Fallback to default projects if none in database -->
                <div class="project-card">
                    <h3>Tic-Tac-Toe Game</h3>
                    <p>This system offers a modern gaming experience with intelligent AI and stunning visual effects.</p>
                    <div class="tech-tags">
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">CSS</span>
                        <span class="tech-tag">JavaScript</span>
                    </div>
                    <a href="" class="project-link">View my Work</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="section-header">
            <h2>Get In Touch</h2>
            <p>Let's work together on your next project</p>
        </div>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Let's Connect</h3>
                <p>I made the this page simple so you can easily tell me what you need,<br> making the jump from your idea to my work as easy as possible. Just <br> fill out the form or use one of the links, and you can expect a quick, <br> personal reply from me so we can start building your project together.</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        <span><?php echo $personal_info ? htmlspecialchars($personal_info['email']) : 'matttaway11@gmail.com'; ?></span>
                    </div>
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                        <span><?php echo $personal_info ? htmlspecialchars($personal_info['phone']) : '+63 927 035 4239'; ?></span>
                    </div>
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        <span><?php echo $personal_info ? htmlspecialchars($personal_info['address']) : 'Pili, Camarines Sur, Philippines'; ?></span>
                    </div>
                </div>
            </div>

            <form class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <span id="year"></span> <?php echo $personal_info ? htmlspecialchars($personal_info['full_name']) : 'Mark Laurence Taway'; ?>. All Rights Reserved.</p>
        <p>Email: <?php echo $personal_info ? htmlspecialchars($personal_info['email']) : 'matttaway11@gmail.com'; ?> <br> Phone: <?php echo $personal_info ? htmlspecialchars($personal_info['phone']) : '+63 927 035 4239'; ?></p>
    </footer>

    <script src="script.js"></script>
</body>
</html>