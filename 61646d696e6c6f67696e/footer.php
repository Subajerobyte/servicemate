<?php
?>
<footer class="sticky-footer" id="page-bottom">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Jerobyte .com <?=date('Y')?> <div id="demo" style="display:none"></div></span>
				<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
        </div>
    </footer>
	<script>
	OneSignal.push(function() {
  OneSignal.getUserId(function(userId) {
    console.log("OneSignal User ID:", userId);
$.ajax({
 type: "POST",
 url: "saveusers.php",
 data: {
 loginid: '<?=$_SESSION["email"]?>',
 userid: userId
 },
 cache: false,
 success: function(data) {
 
 },
 error: function(xhr, status, error) {
 console.error(xhr);
 }
 });
  });
});
	</script>
<script>
var all = document.getElementsByTagName("textarea");
for(var i = 0, max = all.length; i < max; i++) 
{
    const textarea = all[i];
    textarea.addEventListener("input", function (e) {
      this.style.height = "auto";
      this.style.height = this.scrollHeight + "px";
    });
    textarea.addEventListener("click", function (e) {
      this.style.height = "auto";
      this.style.height = this.scrollHeight + "px";
    });
}
</script>