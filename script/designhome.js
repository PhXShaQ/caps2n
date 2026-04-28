lucide.createIcons();
    function toggleAccountModal() {
        const modal = document.getElementById('accountModal');
        modal.classList.toggle('hidden');
    }

    // Close when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('accountModal');
        const trigger = document.querySelector('.profile-trigger');
        if (modal && !modal.contains(event.target) && !trigger.contains(event.target)) {
            modal.classList.add('hidden');
        }
    }

window.addEventListener("load", function () {
        document.body.style.opacity = "1";
        document.body.style.transform = "translateY(0)";
    });

    // Smooth page transition
    function navigateTo(url) {
        document.body.style.opacity = "0";
        document.body.style.transform = "translateY(15px)";
        
        setTimeout(function () {
            window.location.href = url;
        }, 400);
    }