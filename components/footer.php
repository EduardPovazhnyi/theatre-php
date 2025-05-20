<style>p {text-align: center;}</style>
<p class="text-[#880707] text-[20px] font-semibold mt-4">Contact Us: Tel: 01234 987654 - Email: clydetheatre@example.com</p>

<script>

var toggleOpen = document.getElementById('toggleOpen');
var toggleClose = document.getElementById('toggleClose');
var collapseMenu = document.getElementById('collapseMenu');

function handleClick() {
  if (collapseMenu.style.display === 'block') {
    collapseMenu.style.display = 'none';
  } else {
    collapseMenu.style.display = 'block';
  }
}

toggleOpen.addEventListener('click', handleClick);
toggleClose.addEventListener('click', handleClick);

</script>

</html>
</body>