// document.addEventListener("DOMContentLoaded", function() {
//     const menuItems = document.querySelectorAll(".menu-item");
//     const sections = document.querySelectorAll(".section");

//     menuItems.forEach(item => {
//         item.addEventListener("click", function(event) {
//             event.preventDefault();

//             // Remove a classe 'active' de todos os itens do menu
//             menuItems.forEach(link => link.classList.remove("active"));

//             // Adiciona 'active' ao item clicado
//             this.classList.add("active");

//             // Esconde todas as seções
//             sections.forEach(section => section.classList.remove("active"));

//             // Mostra a seção correspondente
//             const sectionId = this.getAttribute("data-section");
//             document.getElementById(sectionId).classList.add("active");
//         });
//     });

//     // Mostrar "Dados Pessoais" por padrão
//     document.getElementById("dados-pessoais").classList.add("active");
// });
