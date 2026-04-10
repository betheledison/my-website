// AURA Logic Protocol
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { hour12: false });
    const clockElement = document.getElementById('live-clock');
    
    if (clockElement) {
        clockElement.innerText = `SYSTEM_TIME: ${timeString}`;
    }
}

// Update every second
setInterval(updateClock, 1000);
updateClock();

console.log("AURA Terminal Logic: Initialized.");
