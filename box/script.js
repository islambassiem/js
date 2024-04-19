const button = document.getElementById('button');
const box = document.getElementById('box');

let open = false;

button.addEventListener('click', (event) => {
  box.classList.toggle('open');
  event.target.innerText = (open ? 'Open' : 'Close' );
  open = !open;
});
