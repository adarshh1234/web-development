document.getElementById("changeColorBtn").addEventListener("click", function() {
    // Generate a random color
    let randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);

    // Remove the gradient and apply solid color to body
    document.body.style.background = randomColor;
    document.documentElement.style.background = randomColor; // Apply to entire page
});
