// HealthWise Interactive Functions

// Navigation functionality
document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Navbar background on scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });
    }

    // Initialize AI Dashboard visibility
    initializeAIDashboard();
});

// Scroll to section function
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Modal functions
function openModal() {
    const modal = document.getElementById('modal-overlay');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal() {
    const modal = document.getElementById('modal-overlay');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function closeMealPlanModal() {
    const modal = document.getElementById('meal-plan-modal-overlay');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function showMealPlanDetails() {
    const modal = document.getElementById('meal-plan-modal-overlay');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        loadMealPlanData();
    }
}

// Dashboard action functions
function logVitals() {
    openModal();
}

function scheduleAppointment() {
    alert('Appointment scheduling feature coming soon!');
}

function generateReport() {
    window.print();
}

function addMedication() {
    const medicationList = document.getElementById('medication-list');
    if (medicationList) {
        const newMedication = document.createElement('div');
        newMedication.className = 'medication-item';
        newMedication.innerHTML = `
            <div class="medication-info">
                <span class="medication-name">New Medication</span>
                <span class="medication-time">Set Time</span>
            </div>
            <button class="btn btn-small" onclick="markTaken(this)">Take</button>
        `;
        medicationList.appendChild(newMedication);
    }
}

function markTaken(button) {
    button.textContent = 'Taken';
    button.classList.add('btn-success');
    button.disabled = true;
}

// AI Health Assessment Functions
function saveVitals() {
    const form = document.getElementById('vitals-form');
    const analyzeButton = document.querySelector('.btn-analyze');
    
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Show loading state
    analyzeButton.classList.add('loading');
    analyzeButton.disabled = true;

    // Collect form data
    const formData = new FormData(form);
    const healthData = {};
    
    for (let [key, value] of formData.entries()) {
        healthData[key] = value;
    }

    // Simulate AI analysis (in real app, this would be an API call)
    setTimeout(() => {
        const analysisResult = simulateAIAnalysis(healthData);
        displayAIResults(analysisResult);
        
        // Hide loading state
        analyzeButton.classList.remove('loading');
        analyzeButton.disabled = false;
        
        // Close modal and show AI dashboard
        closeModal();
        showAIDashboard();
    }, 3000);
}

function simulateAIAnalysis(healthData) {
    // Calculate BMI
    const weight = parseFloat(healthData.weightKg) || 70;
    const height = parseFloat(healthData.heightCm) || 170;
    const bmi = weight / ((height / 100) ** 2);
    
    // Calculate age from date of birth or use provided age
    const age = parseInt(healthData.age) || 30;
    
    // Calculate health score based on inputs
    let healthScore = 100;
    
    // BMI scoring
    if (bmi < 18.5 || bmi > 30) healthScore -= 20;
    else if (bmi > 25) healthScore -= 10;
    
    // Age factor
    if (age > 65) healthScore -= 10;
    else if (age > 45) healthScore -= 5;
    
    // Lifestyle factors
    if (healthData.smokingHabits === 'regular' || healthData.smokingHabits === 'heavy') healthScore -= 25;
    if (healthData.physicalActivity === 'sedentary') healthScore -= 15;
    if (healthData.existingConditions !== 'none') healthScore -= 15;
    
    // Determine risk level
    let riskLevel = 'LOW RISK';
    let riskClass = 'risk-low';
    
    if (healthScore < 60) {
        riskLevel = 'HIGH RISK';
        riskClass = 'risk-high';
    } else if (healthScore < 80) {
        riskLevel = 'MODERATE RISK';
        riskClass = 'risk-moderate';
    }

    // Generate recommendations
    const recommendations = generateRecommendations(healthData, bmi, healthScore);
    
    // Generate meal plan
    const mealPlan = generateMealPlan(healthData, bmi);

    return {
        healthScore: Math.max(healthScore, 30),
        riskLevel: riskLevel,
        riskClass: riskClass,
        bmi: bmi.toFixed(1),
        analysis: generateAnalysisText(healthScore, bmi, age),
        recommendations: recommendations,
        mealPlan: mealPlan,
        timestamp: new Date().toLocaleString()
    };
}

function generateAnalysisText(score, bmi, age) {
    if (score >= 80) {
        return `Excellent health profile! Your BMI of ${bmi.toFixed(1)} is in a healthy range, and your lifestyle choices support long-term wellness. Keep up the great work!`;
    } else if (score >= 60) {
        return `Good health foundation with room for improvement. Your current lifestyle shows positive aspects, but there are opportunities to enhance your overall wellness.`;
    } else {
        return `Your health assessment indicates several areas that would benefit from attention. With targeted lifestyle changes, you can significantly improve your health outcomes.`;
    }
}

function generateRecommendations(healthData, bmi, score) {
    const recommendations = [];

    // BMI-based recommendations
    if (bmi > 25) {
        recommendations.push({
            category: 'Weight Management',
            title: 'Achieve Healthy Weight',
            description: 'Focus on gradual weight loss through balanced nutrition and regular exercise.',
            timeframe: 'Next 3-6 months',
            priority: 'high'
        });
    }

    // Activity recommendations
    if (healthData.physicalActivity === 'sedentary') {
        recommendations.push({
            category: 'Physical Activity',
            title: 'Increase Daily Movement',
            description: 'Start with 30 minutes of moderate exercise, 5 days per week.',
            timeframe: 'Start this week',
            priority: 'high'
        });
    }

    // Smoking recommendations
    if (healthData.smokingHabits && healthData.smokingHabits !== 'never') {
        recommendations.push({
            category: 'Lifestyle',
            title: 'Smoking Cessation',
            description: 'Consider joining a smoking cessation program or consult with your healthcare provider.',
            timeframe: 'Immediate',
            priority: 'high'
        });
    }

    // Diet recommendations
    if (healthData.dietaryHabits === 'processed') {
        recommendations.push({
            category: 'Nutrition',
            title: 'Improve Diet Quality',
            description: 'Incorporate more whole foods, fruits, and vegetables into your daily meals.',
            timeframe: 'Next 2 weeks',
            priority: 'medium'
        });
    }

    // Default recommendations if none specific
    if (recommendations.length === 0) {
        recommendations.push({
            category: 'Preventive Care',
            title: 'Regular Health Checkups',
            description: 'Schedule annual physical exams and recommended screenings.',
            timeframe: 'Next 3 months',
            priority: 'low'
        });
        
        recommendations.push({
            category: 'Wellness',
            title: 'Stress Management',
            description: 'Practice stress-reduction techniques like meditation or yoga.',
            timeframe: 'Daily practice',
            priority: 'low'
        });
    }

    return recommendations;
}

function generateMealPlan(healthData, bmi) {
    // Sample 7-day meal plan based on dietary preferences
    const mealPlan = {
        'Monday': {
            breakfast: [
                { name: 'Oatmeal with berries', description: 'Steel-cut oats with mixed berries', nutrition: 'High fiber, antioxidants' },
                { name: 'Green tea', description: 'Antioxidant-rich beverage' }
            ],
            lunch: [
                { name: 'Grilled chicken salad', description: 'Mixed greens with lean protein', nutrition: 'High protein, low carb' },
                { name: 'Olive oil dressing', description: 'Heart-healthy fats' }
            ],
            dinner: [
                { name: 'Baked salmon', description: 'With roasted vegetables', nutrition: 'Omega-3 fatty acids' },
                { name: 'Quinoa', description: 'Complete protein grain' }
            ]
        },
        // Add more days as needed
        'Tuesday': {
            breakfast: [
                { name: 'Greek yogurt parfait', description: 'With nuts and seeds', nutrition: 'Probiotics, protein' }
            ],
            lunch: [
                { name: 'Vegetable soup', description: 'With whole grain bread', nutrition: 'Fiber, vitamins' }
            ],
            dinner: [
                { name: 'Turkey meatballs', description: 'With zucchini noodles', nutrition: 'Lean protein, low carb' }
            ]
        }
        // Continue for all 7 days...
    };

    return mealPlan;
}

function displayAIResults(results) {
    // Update AI dashboard elements
    const healthScoreElement = document.getElementById('ai-health-score');
    const riskBadgeElement = document.getElementById('ai-risk-badge');
    const analysisTextElement = document.getElementById('ai-analysis-text');
    const timestampElement = document.getElementById('ai-last-analysis');
    const recommendationsList = document.getElementById('ai-recommendations-list');

    if (healthScoreElement) healthScoreElement.textContent = results.healthScore;
    if (riskBadgeElement) {
        riskBadgeElement.textContent = results.riskLevel;
        riskBadgeElement.className = 'risk-badge ' + results.riskClass;
    }
    if (analysisTextElement) analysisTextElement.textContent = results.analysis;
    if (timestampElement) timestampElement.textContent = `Last updated: ${results.timestamp}`;

    // Update progress bars
    updateProgressBars(results);

    // Display recommendations
    if (recommendationsList && results.recommendations) {
        recommendationsList.innerHTML = '';
        results.recommendations.forEach(rec => {
            const recElement = document.createElement('div');
            recElement.className = `recommendation-item priority-${rec.priority}`;
            recElement.innerHTML = `
                <strong>${rec.title}</strong>
                <p>${rec.description}</p>
                <div class="timeframe">${rec.timeframe}</div>
                <button class="btn btn-small btn-toggle-completion" onclick="toggleRecommendation(this)">Mark Done</button>
            `;
            recommendationsList.appendChild(recElement);
        });
    }

    // Store meal plan data globally for modal
    window.currentMealPlan = results.mealPlan;
}

function updateProgressBars(results) {
    const bmiBar = document.getElementById('bmi-bar');
    const bmiLabel = document.getElementById('bmi-label');
    const healthScoreBar = document.getElementById('health-score-bar');
    const healthScoreLabel = document.getElementById('health-score-label');

    if (bmiBar && bmiLabel) {
        const bmiPercentage = Math.min((parseFloat(results.bmi) / 40) * 100, 100);
        bmiBar.style.width = bmiPercentage + '%';
        bmiLabel.textContent = `BMI: ${results.bmi}`;
        
        // Color coding for BMI
        if (results.bmi < 18.5 || results.bmi > 30) {
            bmiBar.style.backgroundColor = '#ef4444'; // Red
        } else if (results.bmi > 25) {
            bmiBar.style.backgroundColor = '#f59e0b'; // Orange
        } else {
            bmiBar.style.backgroundColor = '#10b981'; // Green
        }
    }

    if (healthScoreBar && healthScoreLabel) {
        healthScoreBar.style.width = results.healthScore + '%';
        healthScoreLabel.textContent = `Score: ${results.healthScore}`;
        
        // Color coding for health score
        if (results.healthScore >= 80) {
            healthScoreBar.style.backgroundColor = '#10b981'; // Green
        } else if (results.healthScore >= 60) {
            healthScoreBar.style.backgroundColor = '#f59e0b'; // Orange
        } else {
            healthScoreBar.style.backgroundColor = '#ef4444'; // Red
        }
    }
}

function toggleRecommendation(button) {
    const recItem = button.closest('.recommendation-item');
    if (recItem.classList.contains('completed')) {
        recItem.classList.remove('completed');
        button.textContent = 'Mark Done';
        button.classList.remove('btn-success');
    } else {
        recItem.classList.add('completed');
        button.textContent = 'Completed';
        button.classList.add('btn-success');
    }
}

function loadMealPlanData() {
    const modalBody = document.getElementById('meal-plan-modal-body');
    if (!modalBody || !window.currentMealPlan) return;

    let content = '';
    Object.entries(window.currentMealPlan).forEach(([day, meals]) => {
        content += `
            <div class="meal-plan-day">
                <h4>${day}</h4>
        `;
        
        Object.entries(meals).forEach(([mealType, items]) => {
            content += `
                <div class="meal-type">
                    <h5>${mealType.charAt(0).toUpperCase() + mealType.slice(1)}</h5>
                    <ul>
            `;
            
            items.forEach(item => {
                content += `
                    <li>
                        <strong>${item.name}</strong>
                        <p>${item.description}</p>
                        ${item.nutrition ? `<span class="nutritional-focus">Focus: ${item.nutrition}</span>` : ''}
                    </li>
                `;
            });
            
            content += '</ul></div>';
        });
        
        content += '</div>';
    });

    modalBody.innerHTML = content;
}

function initializeAIDashboard() {
    // Check if there's stored AI data and show dashboard accordingly
    const aiDashboard = document.getElementById('ai-dashboard');
    if (aiDashboard) {
        // For demo purposes, keep it hidden initially
        // In a real app, you'd check for stored user data
    }
}

function showAIDashboard() {
    const aiDashboard = document.getElementById('ai-dashboard');
    if (aiDashboard) {
        aiDashboard.classList.remove('hidden');
        // Scroll to AI dashboard
        setTimeout(() => {
            aiDashboard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 500);
    }
}

// Contact form submission
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! We\'ll get back to you soon.');
            this.reset();
        });
    }
});

// Section navigation for multi-step form
let currentSection = 1;
const totalSections = 3;

function nextSection() {
    if (currentSection < totalSections) {
        // Validate current section
        const currentForm = document.querySelector(`.form-section[data-section="${currentSection}"]`);
        const inputs = currentForm.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.focus();
                isValid = false;
                return false;
            }
        });
        
        if (!isValid) {
            alert('Please fill in all required fields before proceeding.');
            return;
        }
        
        // Hide current section
        document.querySelector(`.form-section[data-section="${currentSection}"]`).classList.remove('active');
        document.querySelector(`.step[data-step="${currentSection}"]`).classList.add('completed');
        document.querySelector(`.step[data-step="${currentSection}"]`).classList.remove('active');
        
        // Show next section
        currentSection++;
        document.querySelector(`.form-section[data-section="${currentSection}"]`).classList.add('active');
        document.querySelector(`.step[data-step="${currentSection}"]`).classList.add('active');
        
        // Update progress bar
        const progressFill = document.querySelector('.progress-fill');
        if (progressFill) {
            progressFill.style.width = `${(currentSection / totalSections) * 100}%`;
        }
        
        // Update navigation buttons
        updateNavigationButtons();
    }
}

function previousSection() {
    if (currentSection > 1) {
        // Hide current section
        document.querySelector(`.form-section[data-section="${currentSection}"]`).classList.remove('active');
        document.querySelector(`.step[data-step="${currentSection}"]`).classList.remove('active');
        
        // Show previous section
        currentSection--;
        document.querySelector(`.form-section[data-section="${currentSection}"]`).classList.add('active');
        document.querySelector(`.step[data-step="${currentSection}"]`).classList.add('active');
        document.querySelector(`.step[data-step="${currentSection}"]`).classList.remove('completed');
        
        // Update progress bar
        const progressFill = document.querySelector('.progress-fill');
        if (progressFill) {
            progressFill.style.width = `${(currentSection / totalSections) * 100}%`;
        }
        
        // Update navigation buttons
        updateNavigationButtons();
    }
}

function updateNavigationButtons() {
    const prevButtons = document.querySelectorAll('.section-navigation .btn-secondary');
    const nextButtons = document.querySelectorAll('.section-navigation .btn-primary:not(.btn-analyze)');
    
    prevButtons.forEach(btn => {
        btn.style.display = currentSection === 1 ? 'none' : 'inline-block';
    });
    
    nextButtons.forEach(btn => {
        btn.style.display = currentSection === totalSections ? 'none' : 'inline-block';
    });
}

// Print functionality
function printRecommendations() {
    const aiDashboard = document.getElementById('ai-dashboard');
    if (aiDashboard && !aiDashboard.classList.contains('hidden')) {
        // Set print-friendly title
        document.title = 'HealthWise - Personal Health Report';
        
        // Show print button as visible for a moment (for print CSS)
        const printBtn = document.getElementById('print-recommendations');
        printBtn.classList.add('printing');
        
        // Trigger print
        window.print();
        
        // Reset
        setTimeout(() => {
            printBtn.classList.remove('printing');
        }, 1000);
    } else {
        alert('Please complete a health assessment first to generate a printable report.');
    }
}

function showPrintButton() {
    const printBtn = document.getElementById('print-recommendations');
    if (printBtn) {
        printBtn.classList.add('visible');
    }
}

function hidePrintButton() {
    const printBtn = document.getElementById('print-recommendations');
    if (printBtn) {
        printBtn.classList.remove('visible');
    }
}

// Enhanced showAIDashboard function
function showAIDashboard() {
    const aiDashboard = document.getElementById('ai-dashboard');
    if (aiDashboard) {
        aiDashboard.classList.remove('hidden');
        showPrintButton(); // Show print button when AI dashboard is visible
        
        // Scroll to AI dashboard
        setTimeout(() => {
            aiDashboard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 500);
    }
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    const modals = document.querySelectorAll('.modal-overlay');
    modals.forEach(modal => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});

// Initialize navigation on page load
document.addEventListener('DOMContentLoaded', function() {
    updateNavigationButtons();
    
    // Initialize section navigation
    currentSection = 1;
    const sections = document.querySelectorAll('.form-section');
    sections.forEach((section, index) => {
        if (index === 0) {
            section.classList.add('active');
        } else {
            section.classList.remove('active');
        }
    });
});