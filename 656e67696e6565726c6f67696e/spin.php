<div id="overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); display: none; justify-content: center; align-items: center; z-index: 9999;">
<div class="spinner-border text-primary" role="status">
<span class="visually-hidden"></span>
</div>
</div>
<script>
function showLoadingOverlay() {
document.getElementById('overlay').style.display = 'flex';
}
function hideLoadingOverlay() {
document.getElementById('overlay').style.display = 'none';
}
function submitForm() {
if (!validateForm()) {
return;
}
showLoadingOverlay();
setTimeout(function () {
hideLoadingOverlay();
var success = true;
if (success) {
// alert('Form submitted successfully!');
} else {
//alert('Form submission failed!');
}
}, 300000);
}
function validateFormAndSubmit() {
if (!document.getElementById('myForm').checkValidity()) {
alert('Please fill in all required fields');
return;
}
showLoadingOverlay();
submitForm();
}
</script>