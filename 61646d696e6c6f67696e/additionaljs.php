<style>
.btn-scroll
{
	text:<?=$_SESSION['darkcolor']?>;
	background:#fffff;
	font-weight: 250;
}

 .scroll thead {
      position: sticky;
      top: 0;
      background-color: <?=$_SESSION['lightbgcolor1']?>; 
    }
</style>
<style>
.scroll {
    max-height: 600px;
    overflow: auto;
}
@media (max-width: 768px) {
    .floating-container {
        right: 10px; /* Adjust as needed for smaller screens */
        transform: translateX(0);
    }
}
.scroll::-webkit-scrollbar {
  width: 5px;
  height: 5px;
  
}
.scroll::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.0);
	background-color: <?=$_SESSION['lightbgcolor']?>;
}


.scroll::-webkit-scrollbar-thumb
{
	background-color:<?=$_SESSION['darkcolor']?>;
	border: 2	px solid <?=$_SESSION['darkcolor']?>;
}
</style>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const tableContainer = document.querySelector('.table-responsive');
    const scrollLeftBtn = document.getElementById('scrollLeftBtn');
    const scrollRightBtn = document.getElementById('scrollRightBtn');
    const scrollUpBtn = document.getElementById('scrollUpBtn');
    const scrollDownBtn = document.getElementById('scrollDownBtn');
    const scrollDistance = 25; // Adjust as needed
    if(scrollLeftBtn==true)
	{
    scrollLeftBtn.addEventListener('click', function () {
      tableContainer.scrollLeft -= scrollDistance;
    });
	
	
    scrollRightBtn.addEventListener('click', function () {
      tableContainer.scrollLeft += scrollDistance;
    });

    scrollUpBtn.addEventListener('click', function () {
      tableContainer.scrollTop -= scrollDistance;
    });

    scrollDownBtn.addEventListener('click', function () {
      tableContainer.scrollTop += scrollDistance;
    })
	}
  });
</script>
<script>
  let scrollInterval;
  const tableContainer = document.querySelector('.table-responsive');
  const scrollDistance = 5; // Adjust as needed

  function startContinuousScroll(direction) {
    scrollInterval = setInterval(function () {
      if (direction === 'left') {
        tableContainer.scrollLeft -= scrollDistance;
      } else if (direction === 'right') {
        tableContainer.scrollLeft += scrollDistance;
      } else if (direction === 'up') {
        tableContainer.scrollTop -= scrollDistance;
      } else if (direction === 'down') {
        tableContainer.scrollTop += scrollDistance;
      }
    }, 20); // Adjust the interval for scrolling speed
  }

  function stopContinuousScroll() {
    clearInterval(scrollInterval);
}
</script>
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
const numericInputs = document.querySelectorAll('input[type="text"][inputmode="numeric"]');
numericInputs.forEach(input => {
input.addEventListener('input', function(event) {
// Remove all non-numeric characters
const cleanedValue = event.target.value.replace(/[^0-9]/g, ''); 
event.target.value = cleanedValue;
});
});
});
</script>