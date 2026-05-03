

let voiceRecorder;
let voiceChunks = [];
let startTime;
let timerInterval;

function startVoiceRecord() {
    navigator.mediaDevices.getUserMedia({ audio: true }).then(stream => {
        voiceRecorder = new MediaRecorder(stream);
        voiceChunks = [];

        voiceRecorder.ondataavailable = e => voiceChunks.push(e.data);
        
        voiceRecorder.onstop = () => {
            const blob = new Blob(voiceChunks, { type: 'audio/mp3' });
            const audioURL = URL.createObjectURL(blob);
            document.getElementById('voice-playback').src = audioURL;
            document.getElementById('audio-preview-container').classList.remove('hidden');
            
            // Itago ang stream
            stream.getTracks().forEach(track => track.stop());
        };

        voiceRecorder.start();
        startTimer();

        // UI Toggle
        document.getElementById('v-start-btn').classList.add('hidden');
        document.getElementById('v-stop-btn').classList.remove('hidden');
        document.getElementById('audio-preview-container').classList.add('hidden');
    });
}

function stopVoiceRecord() {
    voiceRecorder.stop();
    stopTimer();
    document.getElementById('v-start-btn').classList.remove('hidden');
    document.getElementById('v-stop-btn').classList.add('hidden');
}

// Timer Functions
function startTimer() {
    startTime = Date.now();
    timerInterval = setInterval(() => {
        let elapsedTime = Date.now() - startTime;
        let seconds = Math.floor((elapsedTime / 1000) % 60);
        let minutes = Math.floor((elapsedTime / (1000 * 60)) % 60);
        document.getElementById('timer-display').innerText = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }, 1000);
}

function stopTimer() {
    clearInterval(timerInterval);
}

function discardRecording() {
    document.getElementById('audio-preview-container').classList.add('hidden');
    document.getElementById('timer-display').innerText = "00:00";
}





function startTranscription() {
    // ... yung ibang code kanina ...
    document.getElementById('stop-btn').classList.add('recording-active');
}








function addToMeetingList(filename, type) {
    const listContainer = document.getElementById('meeting-list-container');
    
    // Alisin ang "No recordings yet" kung meron
    const emptyMsg = listContainer.querySelector('.empty-msg');
    if (emptyMsg) emptyMsg.remove();

    const date = new Date().toLocaleDateString();
    const icon = type === 'speech' ? 'video' : 'mic';

    const itemHTML = `
        <div class="meeting-item" onclick="playMeeting('${filename}')">
            <i data-lucide="${icon}"></i>
            <div class="meeting-info">
                <span>${filename}</span>
                <small>${date}</small>
            </div>
        </div>
    `;

    listContainer.insertAdjacentHTML('afterbegin', itemHTML);
    lucide.createIcons(); // Para lumitaw ang icons
}

// Gamitin ito pagkatapos ng matagumpay na upload
function uploadVoiceRecord() {
    // ... yung upload logic mo papuntang save_voice.php ...
    
    // Halimbawa, pag success:
    const mockFilename = "Voice Record " + (document.querySelectorAll('.meeting-item').length + 1);
    addToMeetingList(mockFilename, 'voice');
    
    alert("Saved to Cloud!");
    discardRecording(); // I-reset ang UI gaya ng nasa image
}







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
            // folder
            

            function closePreview(){
                document.getElementById("overlay").style.display = "none";
            }

            function stopRecording(){
                document.getElementById("transcript").innerText += "\n\nRecording stopped.";
            }

            document.getElementById("overlay").addEventListener("click", function(e){
                if(e.target === this){
                    closePreview();
                }
            });

            // recording
            let recognition;
            let isRecording = false;

            function openPreview(title){
                document.getElementById("previewTitle").innerText = title;
                document.getElementById("overlay").style.display = "flex";
                document.getElementById("transcript").innerText = "Listening... Speak now.";

                startRecording();
            }

            function closePreview(){
                document.getElementById("overlay").style.display = "none";
                stopRecording();
            }

            function startRecording(){
                if (!('webkitSpeechRecognition' in window)) {
                    alert("Speech Recognition not supported in this browser. Use Google Chrome.");
                    return;
                }

                recognition = new webkitSpeechRecognition();
                recognition.continuous = true;
                recognition.interimResults = true;
                recognition.lang = "en-US";

                recognition.onstart = function(){
                    isRecording = true;
                    console.log("Recording started...");
                };

                recognition.onresult = function(event){
                    let transcript = "";
                    for (let i = event.resultIndex; i < event.results.length; i++) {
                        transcript += event.results[i][0].transcript;
                    }
                    document.getElementById("transcript").innerText = transcript;
                };

                recognition.onerror = function(event){
                    console.error("Error:", event.error);
                };

                recognition.start();
            }

            function stopRecording(){
                if (recognition && isRecording) {
                    recognition.stop();
                    isRecording = false;
                    document.getElementById("transcript").innerText += "\n\nRecording stopped.";
                }
            }

            document.getElementById("overlay").addEventListener("click", function(e){
                if(e.target === this){
                    closePreview();
                }
            });        
        
        
        
        const searchInput = document.querySelector('.inner-search-input');

            searchInput.addEventListener('keyup', function() {
                let query = this.value;
                
                // AJAX call papuntang search_meetings.php
                fetch(`search_meetings.php?q=${query}`)
                .then(response => response.text())
                .then(data => {
                    // I-display ang resulta sa ilalim ng sidebar
                    document.querySelector('.meeting-list').innerHTML = data;
                });
            });


            function switchSection(sectionId) {
    // 1. Itago lahat ng sections
    const allSections = document.querySelectorAll('.content-section');
    allSections.forEach(section => {
        section.classList.add('hidden');
    });

    // 2. Ipakita ang section na tinawag
    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.classList.remove('hidden');
    }

    // 3. I-update ang hitsura ng buttons (active state)
    const allButtons = document.querySelectorAll('.inner-btn');
    allButtons.forEach(btn => {
        btn.classList.remove('active');
    });

    // Lagyan ng active class ang pinindot na button
    event.currentTarget.classList.add('active');
}


let mediaRecorder;
let audioChunks = [];

async function startTranscription() {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    mediaRecorder = new MediaRecorder(stream);
    audioChunks = [];

    mediaRecorder.ondataavailable = (event) => {
        audioChunks.push(event.data);
    };

    mediaRecorder.onstop = async () => {
        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
        sendToWhisper(audioBlob);
    };

    mediaRecorder.start();
    
    // UI Updates
    document.getElementById('start-btn').classList.add('hidden');
    document.getElementById('stop-btn').classList.remove('hidden');
    document.getElementById('transcript-output').innerHTML = '<p class="loading">Listening...</p>';
}

function stopTranscription() {
    mediaRecorder.stop();
    document.getElementById('start-btn').classList.remove('hidden');
    document.getElementById('stop-btn').classList.add('hidden');
    document.getElementById('transcript-output').innerHTML = '<p class="loading">Processing audio... please wait.</p>';
}

async function sendToWhisper(blob) {
    const formData = new FormData();
    formData.append('audio_data', blob);

    try {
        const response = await fetch('transcribe.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        
        if(result.text) {
            document.getElementById('transcript-output').innerText = result.text;
        } else {
            document.getElementById('transcript-output').innerText = "Error: " + result.error;
        }
    } catch (error) {
        console.error("Transcribe Error:", error);
    }
}











