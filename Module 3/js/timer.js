// Simple countdown timer.
// durationSeconds = how long the quiz lasts
// When it reaches 0, it auto-submits the quiz form.

function startTimer(durationSeconds, displayElementId, formId) {
    let timeLeft = durationSeconds;
    const display = document.getElementById(displayElementId);

    const countdown = setInterval(function () {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        display.textContent =
            "Time Left: " + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            display.textContent = "Time's up!";
            document.getElementById(formId).submit(); // auto-submit the quiz
        }
        timeLeft--;
    }, 1000);
}
