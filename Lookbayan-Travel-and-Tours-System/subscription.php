<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Subscription & Tour Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 2rem;
    }

    h1, h2 {
      text-align: center;
    }

    .pricing-container {
      display: flex;
      justify-content: center;
      gap: 2rem;
      flex-wrap: wrap;
    }

    .plan {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      width: 300px;
      padding: 1.5rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }

    .plan:hover {
      transform: scale(1.02);
    }

    .plan h2 {
      margin-top: 0;
    }

    .price {
      font-size: 24px;
      margin: 0.5rem 0;
    }

    .features {
      list-style: none;
      padding: 0;
    }

    .features li {
      margin: 0.5rem 0;
    }

    .choose-btn {
      background: #000;
      color: white;
      padding: 10px 20px;
      margin-top: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      transition: background 0.3s ease;
    }

    .choose-btn:hover {
      background: #333;
    }

    .note {
      text-align: center;
      margin-top: 2rem;
      font-size: 14px;
      color: #555;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 100;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px;
      border-radius: 8px;
      width: 90%;
      max-width: 400px;
    }

    .modal-content input, .modal-content button {
      width: 100%;
      margin-top: 10px;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    .close-btn {
      background-color: #dc3545;
      color: white;
      border: none;
    }

    .pay-btn {
      background-color: #28a745;
      color: white;
      border: none;
    }

    .confirmation {
      display: none;
      text-align: center;
      margin-top: 3rem;
    }

    .tour-dashboard {
      display: none;
      text-align: center;
      margin-top: 3rem;
    }

    .tour-dashboard form {
      display: inline-block;
      text-align: left;
      margin-top: 1rem;
    }

    .tour-dashboard input,
    .tour-dashboard textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    #tourSuccessMsg {
      color: green;
      margin-top: 1rem;
      display: none;
    }
  </style>
</head>
<body>

<div id="subscriptionHeader">
  <h1>Choose Your Plan</h1>
  <p class="note">Note: Monthly prices are fixed and will not change when switching to yearly billing.</p>
</div>

<div class="pricing-container" id="plansSection">
  <div class="plan" data-plan="Basic" data-price="₱299 / month">
    <h2>Basic</h2>
    <p class="price">₱299 / month</p>
    <ul class="features">
      <li>✔ Up to 3 tour packages</li>
      <li>✔ Booking System</li>
      <li>✔ Basic CRM Module</li>
      <li>❌ No Analytics or HR Module</li>
      <li>❌ 360° Virtual Tour</li>
    </ul>
    <button class="choose-btn">Choose Plan</button>
  </div>

  <div class="plan" data-plan="Standard" data-price="₱499 / month">
    <h2>Standard</h2>
    <p class="price">₱499 / month</p>
    <ul class="features">
      <li>✔ Unlimited Tour Listings</li>
      <li>✔ Booking System</li>
      <li>✔ Basic Virtual Tour</li>
      <li>✔ CRM + Summary Reports</li>
      <li>❌ No HR Module</li>
    </ul>
    <button class="choose-btn">Choose Plan</button>
  </div>

  <div class="plan" data-plan="Premium" data-price="₱999 / month">
    <h2>Premium</h2>
    <p class="price">₱999 / month</p>
    <ul class="features">
      <li>✔ Unlimited Tour Listings</li>
      <li>✔ Booking System + 360° Virtual Tour</li>
      <li>✔ Advanced CRM + Full Reports</li>
      <li>✔ HR & Driver Module</li>
      <li>⭐ Priority Support</li>
    </ul>
    <button class="choose-btn">Choose Plan</button>
  </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="modal">
  <div class="modal-content">
    <h3 id="modalTitle">Payment for Plan</h3>
    <input type="text" placeholder="Cardholder Name" />
    <input type="text" placeholder="Card Number" />
    <input type="text" placeholder="MM/YY" />
    <input type="text" placeholder="CVC" />
    <button class="pay-btn" onclick="confirmPayment()">Pay Now</button>
    <button class="close-btn" onclick="closeModal()">Cancel</button>
  </div>
</div>

<!-- Confirmation Section -->
<div class="confirmation" id="confirmationSection">
  <h2>🎉 Subscription Confirmed!</h2>
  <p id="confirmationMessage"></p>
  <button onclick="goToDashboard()" class="choose-btn">Go to Dashboard</button>
</div>

<!-- Travel Agency Dashboard -->
<div class="tour-dashboard" id="tourDashboard">
  <h2>📍 Add New Tour Package</h2>
  <form id="tourForm" enctype="multipart/form-data" method="POST">
  <label>Tour Title:<br>
    <input type="text" id="tourTitle" name="tourTitle" required>
  </label><br>

  <label>Description:<br>
    <textarea id="tourDesc" name="tourDesc" rows="4"></textarea>
  </label><br>

  <label>Price:<br>
    <input type="number" id="tourPrice" name="tourPrice" required>
  </label><br>

  <label>Upload Image:<br>
    <input type="file" id="tourImage" name="tourImage" accept="image/*" required>
  </label><br>

  <button type="submit" class="pay-btn">Add Tour</button>
</form>
<div id="tourSuccessMsg">✅ Tour has been successfully added!</div>
<div id="tourErrorMsg"></div>
<button onclick="window.location.href='destinations.php'" class="choose-btn" style="margin-top: 1rem;">Back to Destinations</button>
</div>

<script>
  const buttons = document.querySelectorAll(".choose-btn");
  const modal = document.getElementById("paymentModal");
  const modalTitle = document.getElementById("modalTitle");
  const confirmation = document.getElementById("confirmationSection");
  const confirmationMessage = document.getElementById("confirmationMessage");
  const plansSection = document.getElementById("plansSection");
  const dashboard = document.getElementById("tourDashboard");
  const header = document.getElementById("subscriptionHeader");

  let selectedPlan = '';

  buttons.forEach(btn => {
    btn.addEventListener("click", (e) => {
      const planCard = e.target.closest('.plan');
      selectedPlan = planCard.getAttribute("data-plan");
      const planPrice = planCard.getAttribute("data-price");
      modalTitle.textContent = `Payment for ${selectedPlan} Plan (${planPrice})`;
      modal.style.display = "block";

      // Hide heading and note
      header.style.display = "none";
    });
  });

  function closeModal() {
    modal.style.display = "none";

    // Show heading and note again
    header.style.display = "block";
  }

  function confirmPayment() {
    modal.style.display = "none";
    plansSection.style.display = "none";
    confirmation.style.display = "block";
    confirmationMessage.textContent = `You have successfully subscribed to the ${selectedPlan} Plan. Thank you!`;
  }

  function goToDashboard() {
    confirmation.style.display = "none";
    dashboard.style.display = "block";
  }

  document.getElementById("tourForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const form = document.getElementById("tourForm");
  const formData = new FormData(form);

  const successMsg = document.getElementById("tourSuccessMsg");
  const errorMsg = document.getElementById("tourErrorMsg");

  // Reset messages
  successMsg.style.display = "none";
  errorMsg.style.display = "none";
  errorMsg.textContent = "";

  fetch("add_tour.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === "success") {
      form.reset();
      successMsg.style.display = "block";
    } else {
      errorMsg.textContent = "❌ " + data;
      errorMsg.style.display = "block";
    }
  })
  .catch(err => {
    errorMsg.textContent = "❌ Request failed: " + err;
    errorMsg.style.display = "block";
  });
});


  window.onclick = function(event) {
    if (event.target == modal) {
      closeModal();
    }
  };
</script>

</body>
</html>