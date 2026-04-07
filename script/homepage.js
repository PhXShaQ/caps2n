
lucide.createIcons();
function toggleAccountModal() {
    const modal = document.getElementById('accountModal');
    modal.classList.toggle('hidden');
}

// Close when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('accountModal');
    const trigger = document.querySelector('.profile-trigger');
    if (!modal.contains(event.target) && !trigger.contains(event.target)) {
        modal.classList.add('hidden');
    }
}

anime.timeline({loop: true})
  .add({
    targets: '.ml5 .line',
    opacity: [0.5,1],
    scaleX: [0, 1],
    easing: "easeInOutExpo",
    duration: 700
  }).add({
    targets: '.ml5 .line',
    duration: 600,
    easing: "easeOutExpo",
    translateY: (el, i) => (-0.625 + 0.625*2*i) + "em"
  }).add({
    targets: '.ml5 .ampersand',
    opacity: [0,1],
    scaleY: [0.5, 1],
    easing: "easeOutExpo",
    duration: 600,
    
  }).add({
    targets: '.ml5 .letters-left',
    opacity: [0,1],
    translateX: ["0.5em", 0],
    easing: "easeOutExpo",
    duration: 600,
    
  }).add({
    targets: '.ml5 .letters-right',
    opacity: [0,1],
    translateX: ["-0.5em", 0],
    easing: "easeOutExpo",
    duration: 600,
    offset: '-=600'
  }).add({
    targets: '.ml5',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 10000
  });

/* sliding function*/
  function slideTo(index) {
    const track = document.getElementById('mainTrack');
    const buttons = document.querySelectorAll('.tab-btn');

    // 1. Move the track (100% / 4 slides = 25% movement per slide)
    // Pero since container width ang usapan, move by -25% each step
    const percentage = index * 25;
    track.style.transform = `translateX(-${percentage}%)`;

    // 2. Update Active Button Style
    buttons.forEach((btn, i) => {
        if (i === index) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}



