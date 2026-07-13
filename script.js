// ================================
// Student Notes Manager
// Developed by Dhrauv Kumar
// ================================

// Live Clock
function updateClock() {

    const now = new Date();

    const time = now.toLocaleTimeString();

    const date = now.toLocaleDateString('en-IN', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });

    const clock = document.getElementById("clock");
    const dateText = document.getElementById("date");

    if(clock){
        clock.innerHTML = "🕒 " + time;
    }

    if(dateText){
        dateText.innerHTML = "📅 " + date;
    }
}

setInterval(updateClock,1000);

updateClock();

// Fade Animation
document.addEventListener("DOMContentLoaded",()=>{

    document.body.style.opacity="0";

    setTimeout(()=>{
        document.body.style.transition="opacity .8s";
        document.body.style.opacity="1";
    },100);

});

// Table Hover Effect

const rows=document.querySelectorAll("tbody tr");

rows.forEach(row=>{

    row.addEventListener("mouseenter",()=>{

        row.style.transform="scale(1.01)";

    });

    row.addEventListener("mouseleave",()=>{

        row.style.transform="scale(1)";

    });

});