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