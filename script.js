let openBox = document.querySelector('#containercall');
let allbox = document.querySelector('#allbox');
let box1 = document.querySelector('#box1');
let obor1 = document.querySelector('#obor1');
openBox.addEventListener('click', () => {
  if (allbox.style.display == "none") {
     allbox.style.display = "block";
  } else {
     allbox.style.display = "none";
  }
});
box1.addEventListener('click', () => {
  if (obor1.style.display == "none") {
     obor1.style.display = "block";
  } else {
     obor1.style.display = "none";
  }
});
box2.addEventListener('click', () => {
  if (obor2.style.display == "none") {
     obor2.style.display = "block";
  } else {
     obor2.style.display = "none";
  }
});