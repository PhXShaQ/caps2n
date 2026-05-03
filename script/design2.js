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
    
    //speak 
    
    const synth = window.speechSynthesis;
    const textInput = document.getElementById('textToSpeak');
    const voiceSelect = document.getElementById('voiceSelect');
    const rateInput = document.getElementById('rate');
    const speedValue = document.getElementById('speedValue');
    
    let voices = [];
    
    // 1. Load available voices (Male, Female, Different Accents)
    function loadVoices() {
        voices = synth.getVoices();
        voiceSelect.innerHTML = '';

        voices.forEach((voice, i) => {
        const option = document.createElement('option');
        
        // Heto ang dagdag: Titignan kung Tagalog (tl-PH) o Filipino (fil-PH)
        let displayName = `${voice.name} (${voice.lang})`;
        
        if (voice.lang.includes('tl-PH') || voice.lang.includes('fil-PH')) {
            displayName = `🇵🇭 FILIPINO - ${voice.name}`;
            option.style.fontWeight = "bold";
            option.style.color = "#5d0bf5"; // Kulay ng theme mo
        }

        option.textContent = displayName;
        option.value = i;
        voiceSelect.appendChild(option);
    });
    }
    
    // Kailangan ito dahil async ang pag-load ng voices sa ibang browsers
    if (speechSynthesis.onvoiceschanged !== undefined) {
        speechSynthesis.onvoiceschanged = loadVoices;
    }
    
    // 2. Update speed label
    rateInput.addEventListener('input', () => {
        speedValue.innerText = rateInput.value;
    });
    
    // 3. Main Function: Speak!
    function speakText() {
        if (synth.speaking) {
            console.error('Already speaking...');
            return;
        }
    
        if (textInput.value !== '') {
            const utterThis = new SpeechSynthesisUtterance(textInput.value);
            
            // Set selected voice
            const selectedVoice = voices[voiceSelect.value];
            if (selectedVoice) {
                utterThis.voice = selectedVoice;
            }
    
            // Set speed (Rate)
            utterThis.rate = rateInput.value;
    
            synth.speak(utterThis);
        }
    }
    
    // 4. Stop Function
    function stopSpeech() {
        synth.cancel();
    }
    
    // Initialize Lucide icons
    lucide.createIcons();