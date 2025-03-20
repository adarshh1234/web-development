document.addEventListener("DOMContentLoaded", function () {
    let image = document.getElementById("image");
    let text = document.getElementById("text");

    image.addEventListener("mouseover", function () {
        image.src = "new-image.png"; 
        text.innerText = "Zenitsu Agatsuma!";
    });

    image.addEventListener("mouseout", function () {
        image.src = "luffy.png"; 
        text.innerText = "Monkey d Luffy!";
    });
});
