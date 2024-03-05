$(document).ready(function(){

    var btnmenumobile = $('.btn-menumobile')
    $(btnmenumobile).on('click', function(){
        $('.nav-container ul').toggleClass('open');
    })
});
document.getElementById("toggleCadastra").addEventListener("click", function () {
    document.getElementById("login").style.display = "none";
    document.getElementById("cadastra").style.display = "block";
  });
  
   
  
document.getElementById("toggleLogin").addEventListener("click", function () {
    document.getElementById("cadastra").style.display = "none";
    document.getElementById("login").style.display = "block";
  });

const carouselContainer = document.querySelector(".carousel-container");
const slides = document.querySelectorAll(".carousel-slide");
const prevBtn = document.querySelector("#prevBtn");
const nextBtn = document.querySelector("#nextBtn");

let currentIndex = 0;

function showSlide(index) {
    slides.forEach((slide, i) => {
        if (i === index) {
            slide.style.display = "block";
        } else {
            slide.style.display = "none";
        }
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
}

nextBtn.addEventListener("click", nextSlide);
prevBtn.addEventListener("click", prevSlide);

showSlide(currentIndex);

const navContainer = document.querySelector('nav');
const scrollThreshold = 15; // Ajuste conforme necessário

window.addEventListener('scroll', () => {
    const scrollPosition = window.scrollY;

    if (scrollPosition > scrollThreshold) {
        navContainer.classList.add('nav-hidden'); // Adiciona a classe de ocultação
    } else {
        navContainer.classList.remove('nav-hidden'); // Remove a classe de ocultação
    }
});
    

function MostrarSenha() {
        var passwordInput = document.getElementById("senha");
        var PasswordIcon = document.getElementById("MostrarSenha")
        if(passwordInput.type === "password"){
         passwordInput.type = "text";
         PasswordIcon.textContent = "❌"
        }
        else {
            passwordInput.type = "password";
            PasswordIcon.textContent = "👀";
        }
    }

