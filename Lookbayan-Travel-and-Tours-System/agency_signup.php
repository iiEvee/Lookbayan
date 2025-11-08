<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agency Sign Up | Lookbayan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="shortcut icon" href="logoo.png" type="image/x-icon" />
  <link rel="stylesheet" href="agency_signup.css" />
</head>
<body>
  <video autoplay loop muted playsinline class="video-bg">
    <source src="sunset.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="signup-wrapper">
    <div class="signup-card">
      <div class="signup-image"></div>
      <div class="signup-form">
        <form id="signup-form" action="agency_signup_process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        
          <!-- STEP 1 -->
          <div class="form-step active">
            <h2>Agency Information</h2>
            <div class="step">1 of 3</div>
            <input type="text" name="agency_name" placeholder="Agency Name" required />
            <div class="form-row">
              <input type="email" name="agency_email" placeholder="Agency Email" required />
              <input type="text" name="agency_number" placeholder="Agency Number" required />
            </div>
            <input type="text" name="agency_address" placeholder="Agency Address" required />
            <div class="form-actions">
              <button type="button" class="next-btn">Next</button>
            </div>
          </div>

          <!-- STEP 2 -->
          <div class="form-step">
            <h2 class="section-title">Manager Information</h2>
            <div class="step">2 of 3</div>
            <p class="form-instruction">Please fill with additional info</p>
            <div class="form-row">
              <input type="text" name="first_name" placeholder="First Name" required />
              <input type="text" name="last_name" placeholder="Last Name" required />
            </div>
            <input type="password" name="password" placeholder="Password" required />
            <div class="form-actions">
              <button type="button" class="back-btn">Back</button>
              <button type="button" class="next-btn">Next</button>
            </div>
          </div>

          <!-- STEP 3 -->
          <div class="form-step">
            <h2 class="section-title">VERIFICATION</h2>
            <div class="step">3 of 3</div>

            <!-- DOT Accreditation -->
            <label for="dot_number">Verify your Travel Agency</label>
            <div class="form-row">
              <input type="text" name="dot_number" id="dot_number" placeholder="Enter DOT Accreditation #" required pattern="^DOT-\d{6}$" title="Format should be DOT-123456" />
              <select name="region" id="region" required>
                <option value="">Select Region</option>
                <option value="NCR">NCR</option>
                <option value="Region I">Region I</option>
                <option value="Region II">Region II</option>
                <!-- Add more regions as needed -->
              </select>
            </div>

            <!-- Upload Certificate -->
            <label for="certificate">Upload your Accreditation Certificate</label>
            <input type="file" name="certificate" id="certificate" required />

            <!-- Terms and Conditions -->
            <div class="terms-container">
              <label>
                <input type="checkbox" id="terms" required />
                <span>Please accept <a href="terms&condition.html" class="terms-link">terms and conditions</a></span>
              </label>
            </div>

            <!-- Navigation Buttons -->
            <div class="form-actions">
              <button type="button" class="back-btn">Back</button>
              <button type="submit" class="submit-btn">Submit</button>
            </div>
          </div>

        <!-- Back to Home Hyperlink -->
        <div class="form-actions">
            <a href="logsig.php" class="signup-as-traveler-link">
            Sign up as Traveler
            </a>
        </div>

        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript to handle step switching -->
  <script>
    const steps = document.querySelectorAll(".form-step");
    const nextBtns = document.querySelectorAll(".next-btn");
    const backBtns = document.querySelectorAll(".back-btn");

    let currentStep = 0;

    function showStep(index) {
      steps.forEach((step, i) => {
        step.classList.toggle("active", i === index);
      });
    }

    nextBtns.forEach(btn => {
      if (btn.type !== "submit") {
        btn.addEventListener("click", () => {
          if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
          }
        });
      }
    });

    backBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        if (currentStep > 0) {
          currentStep--;
          showStep(currentStep);
        }
      });
    });
  </script>
</body>
</html>
