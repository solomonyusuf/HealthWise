<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthWise - Your Personal Health Companion</title>
    <meta name="description" content="Track your health, monitor vital signs, and stay on top of your wellness journey with HealthWise.">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <svg class="nav-logo" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
                <span class="nav-title">HealthWise</span>
            </div>
            <div class="nav-menu" id="nav-menu">
                <a href="#home" class="nav-link active">Home</a>
                <a href="#features" class="nav-link">Features</a>
                <a href="#dashboard" class="nav-link">Dashboard</a>
                <a href="#ai-dashboard" class="nav-link">AI Insights</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#contact" class="nav-link">Contact</a>
            </div>
            <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Your Health, <span class="text-gradient">Simplified</span>
                </h1>
                <p class="hero-description">
                    Track vital signs, monitor your wellness journey, and take control of your health with our intuitive platform designed for modern healthcare management.
                </p>
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="scrollToSection('dashboard')">
                        Get Started
                    </button>
                    <button class="btn btn-secondary" onclick="scrollToSection('features')">
                        Learn More
                    </button>
                </div>
            </div>
            <div class="hero-visual">
                <div class="health-card">
                    <div class="health-metric">
                        <div class="metric-icon heart-rate"></div>
                        <div class="metric-info">
                            <span class="metric-value">72</span>
                            <span class="metric-unit">BPM</span>
                        </div>
                    </div>
                    <div class="health-metric">
                        <div class="metric-icon blood-pressure"></div>
                        <div class="metric-info">
                            <span class="metric-value">120/80</span>
                            <span class="metric-unit">mmHg</span>
                        </div>
                    </div>
                    <div class="health-metric">
                        <div class="metric-icon temperature"></div>
                        <div class="metric-info">
                            <span class="metric-value">98.6</span>
                            <span class="metric-unit">°F</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Comprehensive Health Tracking</h2>
                <p class="section-description">
                    Everything you need to monitor and improve your health in one place
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Vital Signs Monitoring</h3>
                    <p class="feature-description">
                        Track heart rate, blood pressure, temperature, and other essential health metrics in real-time.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M9 11H5a2 2 0 0 0-2 2v3c0 1.1.9 2 2 2h4m6-6h4a2 2 0 0 1 2 2v3c0 1.1-.9 2-2 2h-4m-6 0a2 2 0 0 0-2-2v-3c0-1.1.9-2 2-2m6 0a2 2 0 0 1 2-2v-3c0-1.1-.9-2-2-2"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Medication Reminders</h3>
                    <p class="feature-description">
                        Never miss a dose with smart medication reminders and prescription tracking.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M3 3v18h18V3H3zm16 16H5V5h14v14z"/>
                            <path d="M7 7h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Health Reports</h3>
                    <p class="feature-description">
                        Generate comprehensive health reports and share them with your healthcare providers.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Data Analytics</h3>
                    <p class="feature-description">
                        Gain insights into your health trends with advanced analytics and visualizations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Section -->
    <section id="dashboard" class="dashboard">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Health Dashboard</h2>
                <p class="section-description">
                    Monitor your health metrics at a glance
                </p>
            </div>
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Today's Vitals</h3>
                        <span class="card-status status-good">Good</span>
                    </div>
                    <div class="vitals-list">
                        <div class="vital-item">
                            <span class="vital-label">Heart Rate</span>
                            <span class="vital-value">72 BPM</span>
                        </div>
                        <div class="vital-item">
                            <span class="vital-label">Blood Pressure</span>
                            <span class="vital-value">120/80 mmHg</span>
                        </div>
                        <div class="vital-item">
                            <span class="vital-label">Temperature</span>
                            <span class="vital-value">98.6°F</span>
                        </div>
                        <div class="vital-item">
                            <span class="vital-label">Weight</span>
                            <span class="vital-value">165 lbs</span>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Medications</h3>
                        <button class="btn btn-small" onclick="addMedication()">Add New</button>
                    </div>
                    <div class="medication-list" id="medication-list">
                        <div class="medication-item">
                            <div class="medication-info">
                                <span class="medication-name">Vitamin D</span>
                                <span class="medication-time">8:00 AM</span>
                            </div>
                            <button class="btn btn-small btn-success" onclick="markTaken(this)">Taken</button>
                        </div>
                        <div class="medication-item">
                            <div class="medication-info">
                                <span class="medication-name">Omega-3</span>
                                <span class="medication-time">12:00 PM</span>
                            </div>
                            <button class="btn btn-small" onclick="markTaken(this)">Take</button>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Health Score</h3>
                    </div>
                    <div class="health-score">
                        <div class="score-circle">
                            <svg class="score-svg" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="45" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                                <circle cx="50" cy="50" r="45" fill="none" stroke="#10b981" stroke-width="8" 
                                        stroke-dasharray="283" stroke-dashoffset="70" stroke-linecap="round"/>
                            </svg>
                            <div class="score-text">
                                <span class="score-number">85</span>
                                <span class="score-label">Health Score</span>
                            </div>
                        </div>
                        <p class="score-description">Great job! Your health metrics are looking good.</p>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Actions</h3>
                    </div>
                    <div class="quick-actions">
                        <button class="action-btn" onclick="logVitals()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                            Log Vitals
                        </button>
                        <button class="action-btn" onclick="scheduleAppointment()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            Schedule
                        </button>
                        <button class="action-btn" onclick="generateReport()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14,2 14,8 20,8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10,9 9,9 8,9"/>
                            </svg>
                            Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Insights Dashboard Section -->
    <section id="ai-dashboard" class="ai-dashboard hidden">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Your Personalized AI Health Insights</h2>
                <p class="section-description">
                    Deep dive into your health profile with AI-driven analysis and tailored recommendations.
                </p>
            </div>
            <div class="ai-dashboard-grid">
                <!-- AI Analysis Summary Card -->
                <div class="dashboard-card ai-summary-card">
                    <div class="card-header">
                        <h3 class="card-title">AI Analysis Summary</h3>
                        <div class="risk-badge" id="ai-risk-badge">LOW RISK</div>
                    </div>
                    <div class="content">
                        <div class="score-circle-small">
                            <span class="score-number-small" id="ai-health-score">85</span>
                            <span class="score-label-small">Health Score</span>
                        </div>
                        <p id="ai-analysis-text" class="analysis-text">Your health metrics are generally good, with a balanced lifestyle and no major immediate concerns. Keep up the good work!</p>
                        <span class="timestamp" id="ai-last-analysis">Last updated: N/A</span>
                    </div>
                </div>

                <!-- Progress Stats/Charts Card -->
                <div class="dashboard-card charts-card">
                    <div class="card-header">
                        <h3 class="card-title">Progress Statistics</h3>
                    </div>
                    <div class="charts-container">
                        <div class="chart-item">
                            <h4>BMI Progress</h4>
                            <div class="bar-chart">
                                <div class="bar-fill" id="bmi-bar" style="width: 0%;"></div>
                                <div class="bar-label" id="bmi-label">N/A</div>
                            </div>
                            <p class="chart-description">Ideal BMI: 18.5 - 24.9</p>
                        </div>
                        <div class="chart-item">
                            <h4>Health Score Trend</h4>
                            <div class="bar-chart">
                                <div class="bar-fill" id="health-score-bar" style="width: 0%;"></div>
                                <div class="bar-label" id="health-score-label">N/A</div>
                            </div>
                            <p class="chart-description">Target: 80+ for Low Risk</p>
                        </div>
                    </div>
                </div>

                <!-- Lifestyle Recommendations Card -->
                <div class="dashboard-card recommendations-card">
                    <div class="card-header">
                        <h3 class="card-title">Personalized Recommendations</h3>
                    </div>
                    <div class="recommendations-list" id="ai-recommendations-list">
                        <!-- Recommendations will be populated here by JavaScript -->
                        <p class="placeholder-text">Complete a health assessment to see your personalized recommendations.</p>
                    </div>
                </div>

                <!-- Meal Plan Access Card -->
                <div class="dashboard-card meal-plan-card">
                    <div class="card-header">
                        <h3 class="card-title">Your Meal Plan</h3>
                    </div>
                    <div class="meal-plan-content">
                        <p id="meal-plan-summary">A 7-day personalized meal plan has been generated for you.</p>
                        <button class="btn btn-primary" onclick="showMealPlanDetails()">View Full Meal Plan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">About HealthWise</h2>
                    <p class="about-description">
                        HealthWise is designed to empower individuals to take control of their health through 
                        comprehensive tracking, intelligent insights, and seamless healthcare management. 
                        Our platform combines cutting-edge technology with user-friendly design to make 
                        health monitoring accessible to everyone.
                    </p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <span class="stat-number">10K+</span>
                            <span class="stat-label">Active Users</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50M+</span>
                            <span class="stat-label">Health Records</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">99.9%</span>
                            <span class="stat-label">Uptime</span>
                        </div>
                    </div>
                </div>
                <div class="about-visual">
                    <div class="feature-showcase">
                        <div class="showcase-item">
                            <div class="showcase-icon">📊</div>
                            <span>Analytics</span>
                        </div>
                        <div class="showcase-item">
                            <div class="showcase-icon">🔒</div>
                            <span>Secure</span>
                        </div>
                        <div class="showcase-item">
                            <div class="showcase-icon">📱</div>
                            <span>Mobile Ready</span>
                        </div>
                        <div class="showcase-item">
                            <div class="showcase-icon">⚡</div>
                            <span>Fast</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-description">
                    Have questions? We'd love to hear from you.
                </p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>support@healthwise.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h3>Phone</h3>
                            <p>+1 (555) 123-4567</p>
                        </div>
                    </div>
                </div>
                <form class="contact-form" id="contact-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="nav-brand">
                        <svg class="nav-logo" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                        <span class="nav-title">HealthWise</span>
                    </div>
                    <p class="footer-description">
                        Empowering healthier lives through intelligent health monitoring and management.
                    </p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Product</h4>
                        <a href="#features">Features</a>
                        <a href="#dashboard">Dashboard</a>
                        <a href="#ai-dashboard">AI Insights</a>
                    </div>
                    <div class="footer-column">
                        <h4>Company</h4>
                        <a href="#about">About</a>
                        <a href="#careers">Careers</a>
                        <a href="#contact">Contact</a>
                    </div>
                    <div class="footer-column">
                        <h4>Support</h4>
                        <a href="#help">Help Center</a>
                        <a href="#privacy">Privacy</a>
                        <a href="#terms">Terms</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 HealthWise. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Modals -->
    <div id="modal-overlay" class="modal-overlay">
        <div class="modal" id="vitals-modal">
            <div class="modal-header">
                <h3>Comprehensive Health Assessment</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p class="modal-description">Complete this detailed assessment to analyze your personalized health insights and recommendations.</p>
            
            <form id="vitals-form">
                <!-- Personal Information Section -->
                <div class="form-section">
                    <h4 class="section-title">👤 Personal Information</h4>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" name="fullName" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="date-birth">Date of Birth</label>
                            <input type="date" id="date-birth" name="dateOfBirth" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" id="age" name="age" min="1" max="120" placeholder="Enter your age" required>
                        </div>
                        <div class="form-group">
                            <label for="weight-kg">Weight (kg)</label>
                            <input type="number" id="weight-kg" name="weightKg" min="20" max="300" step="0.1" placeholder="Enter weight in kilograms" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="height-cm">Height (cm)</label>
                        <input type="number" id="height-cm" name="heightCm" min="100" max="250" placeholder="Enter height in centimeters" required>
                    </div>
                </div>

                <!-- Health Metrics Section -->
                <div class="form-section">
                    <h4 class="section-title">🏥 Health Metrics</h4>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="resting-heart-rate">Resting Heart Rate (BPM)</label>
                            <input type="number" id="resting-heart-rate" name="restingHeartRate" min="40" max="200" placeholder="Enter resting heart rate" required>
                        </div>
                        <div class="form-group">
                            <label for="systolic-bp">Systolic BP (mmHg)</label>
                            <input type="number" id="systolic-bp" name="systolicBP" min="70" max="200" placeholder="Enter systolic blood pressure" required>
                        </div>
                    </div>
                </div>

                <!-- Lifestyle Assessment Section -->
                <div class="form-section">
                    <h4 class="section-title">🏃 Lifestyle Assessment</h4>
                    
                    <div class="form-group">
                        <label for="physical-activity">Physical Activity Level</label>
                        <select id="physical-activity" name="physicalActivity" required>
                            <option value="">Select your activity level</option>
                            <option value="sedentary">Sedentary (little to no exercise)</option>
                            <option value="lightly-active">Lightly Active (light exercise 1-3 days/week)</option>
                            <option value="moderately-active">Moderately Active (moderate exercise 3-5 days/week)</option>
                            <option value="very-active">Very Active (hard exercise 6-7 days/week)</option>
                            <option value="extremely-active">Extremely Active (very hard exercise, physical job)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="general-lifestyle">Your typical weekly physical activity pattern</label>
                        <select id="general-lifestyle" name="generalLifestyle" required>
                            <option value="">Select your lifestyle pattern</option>
                            <option value="very-active">Very Active Lifestyle</option>
                            <option value="active">Active Lifestyle</option>
                            <option value="moderate">Moderate Lifestyle</option>
                            <option value="sedentary">Sedentary Lifestyle</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="dietary-habits">Dietary Habits</label>
                        <select id="dietary-habits" name="dietaryHabits" required>
                            <option value="">Select your dietary pattern</option>
                            <option value="balanced">Balanced Diet (variety of foods)</option>
                            <option value="vegetarian">Vegetarian</option>
                            <option value="vegan">Vegan</option>
                            <option value="keto">Ketogenic</option>
                            <option value="mediterranean">Mediterranean</option>
                            <option value="low-carb">Low Carb</option>
                            <option value="high-protein">High Protein</option>
                            <option value="processed">Mostly Processed Foods</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="smoking-habits">Smoking Habits</label>
                        <select id="smoking-habits" name="smokingHabits" required>
                            <option value="">Select smoking status</option>
                            <option value="never">Never Smoked</option>
                            <option value="former">Former Smoker</option>
                            <option value="occasional">Occasional Smoker</option>
                            <option value="regular">Regular Smoker (less than 1 pack/day)</option>
                            <option value="heavy">Heavy Smoker (1+ pack/day)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="existing-conditions">Overall lifestyle and health habits</label>
                        <select id="existing-conditions" name="existingConditions" required>
                            <option value="">Select existing conditions</option>
                            <option value="none">No Known Conditions</option>
                            <option value="diabetes">Diabetes</option>
                            <option value="hypertension">Hypertension</option>
                            <option value="heart-disease">Heart Disease</option>
                            <option value="asthma">Asthma</option>
                            <option value="arthritis">Arthritis</option>
                            <option value="depression">Depression/Anxiety</option>
                            <option value="multiple">Multiple Conditions</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="family-history">Family History of Diabetes</label>
                        <textarea id="family-history" name="familyHistory" rows="4" placeholder="Please describe any family history of diabetes, including relationship (parent, sibling, grandparent) and type of diabetes if known..."></textarea>
                        <p class="field-description">Detailed family medical history helps improve risk assessment</p>
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
            <button class="btn btn-primary btn-analyze" onclick="saveVitals()">🔍 Analyze My Health Profile</button>
        </div>
    </div>
</div>

<div id="meal-plan-modal-overlay" class="modal-overlay">
    <div class="modal meal-plan-modal">
        <div class="modal-header">
            <h3>🍽️ Your Personalized 7-Day Meal Plan</h3>
            <button class="modal-close" onclick="closeMealPlanModal()">&times;</button>
        </div>
        <div class="modal-body" id="meal-plan-modal-body">
            <!-- Meal plan details will be loaded here -->
            <p class="placeholder-text">No meal plan available. Please complete a health assessment.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeMealPlanModal()">Close</button>
        </div>
    </div>
</div>

    <script src="script.js"></script>
</body>
</html>
