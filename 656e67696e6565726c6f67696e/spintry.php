<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Form Submission with Full Page Loading Overlay</title>
  <style>
    /* Style for the full-page loading overlay */
    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    /* Style for the spinning icon */
    .spinner {
      font-size: 3rem;
      color: #ffffff;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</head>
<body>
  <form id="myForm">
    <!-- Your form fields here -->
    <input type="text" id="field1" placeholder="Field 1" required>
    <input type="text" id="field2" placeholder="Field 2" required>
    <!-- Add more fields as needed -->
    <button type="button" onclick="validateFormAndSubmit()">Submit</button>
  </form>

 <div id="overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); display: none; justify-content: center; align-items: center; z-index: 9999;">
  <div class="spinner-border text-primary" role="status">
    <span class="visually-hidden"></span>
  </div>
</div>

  <script>
    function showLoadingOverlay() {
      document.getElementById('overlay').style.display = 'block';
    }

    function hideLoadingOverlay() {
      document.getElementById('overlay').style.display = 'none';
    }

    function submitForm() {
      // Simulate form submission with a delay
      setTimeout(function () {
        // After the form is processed, hide the loading overlay
        hideLoadingOverlay();

        // You can handle success or failure here
        // For example, you can display a success message or show an error message
        var success = true; // Replace with your actual success condition
        if (success) {
          alert('Form submitted successfully!');
        } else {
          alert('Form submission failed!');
        }
      }, 3000); // Adjust the delay as needed
    }

    function validateFormAndSubmit() {
      // Validate the form
      if (!document.getElementById('myForm').checkValidity()) {
        alert('Please fill in all required fields');
        return;
      }

      // Show the loading overlay when the form is submitted
      showLoadingOverlay();

      // Proceed with form submission
      submitForm();
    }
  </script>
</body>
</html>
