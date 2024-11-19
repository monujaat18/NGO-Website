document.addEventListener("DOMContentLoaded", function() {
    // Target values for each stat without symbols
    const stats = [
        { element: document.querySelector('.stats .stat:nth-child(1) h2'), target: 70 },
        { element: document.querySelector('.stats .stat:nth-child(2) h2'), target: 90 },
        { element: document.querySelector('.stats .stat:nth-child(3) h2'), target: 500},
        { element: document.querySelector('.stats .stat:nth-child(4) h2'), target: 300 }
    ];

    // Function to animate the counting
    function animateCount(element, target, symbol) {
        let count = 0; // Start from 0
        const duration = 2000; // Animation duration in milliseconds
        const incrementTime = Math.floor(duration / target); // Time between increments

        const interval = setInterval(() => {
            count++;
            // Update the text content with the symbol after reaching the target
            element.textContent = count.toLocaleString() + symbol; 
            
            // Stop the interval when the target is reached
            if (count >= target) {
                clearInterval(interval);
                element.textContent = target.toLocaleString() + symbol; // Ensure it shows the final target value
            }
        }, incrementTime);
    }

    // Start the animation for each stat with their respective symbols
    stats.forEach((stat, index) => {
        const symbols = ['%', '+', 'K', '%'];
        animateCount(stat.element, stat.target, symbols[index]);
    });
});
function openModal() {
    document.getElementById("contactModal").style.display = "block";
}

function closeModal() {
    document.getElementById("contactModal").style.display = "none";
}

// Close the modal when the user clicks anywhere outside of it
window.onclick = function(event) {
    var modal = document.getElementById("contactModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function openModal2() {
    document.getElementById("contactModal2").style.display = "block";
}

function closeModal2() {
    document.getElementById("contactModal2").style.display = "none";
}

// Close the modal when the user clicks anywhere outside of it
window.onclick = function(event) {
    var modal2 = document.getElementById("contactModal2");
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}