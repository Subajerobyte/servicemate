<footer class="sticky-footer" id="page-bottom">
        <div class="container my-auto">
          <div class="copyright text-center my-auto"><div id="demo"></div><div id="daddress"></div>
		  <hr>
            <span>Copyright &copy; Jerobyte .com <?=date('Y')?> </span>
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
// alert(data);
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