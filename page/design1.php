<?php
// Include your session check at the very top
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginform.php");
    exit();
}
$userEmail = $_SESSION['email'] ?? 'User';
$initial = strtoupper(substr($userEmail, 0, 1));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meeting Dashboard</title>
        <link rel="shortcut icon" href="logonam.png" type="image/x-icon">
        <script src="https://unpkg.com/lucide@latest"></script>
        <link rel="stylesheet" href="../css/designs.css">
    </head>
    <body>
        <div class="sidebars">
            <div class="logos">
                <img src="../logonam.png" alt="logo"/>
                
            </div>
            <a href="designhome.php" class="menu-item"><i data-lucide="house"></i></a>
            <a href="design1.php" class="menu-item" style="background: var(--purple); color: white;"><i data-lucide="mic"></i></a>
            <a href="design2.php" class="menu-item"><i data-lucide="volume-2"></i></a>
            <a href="design3.php" class="menu-item"><i data-lucide="headphones"></i></a>
            <a href="design4.php" class="menu-item"><i data-lucide="file-audio"></i></a>
        </div>
        <div class="main">
            <div class="topbar">
                <input type="text" class="search" placeholder="Search by title or keyword">
                <div class="profile-section">
                    
                    <div class="profile-trigger" onclick="toggleAccountModal()">
                        <?php echo $initial; ?>
                    </div>
                </div>
                <div id="accountModal" class="account-modal hidden">
                    <div class="modal-avatar-large"><?php echo $initial; ?></div>
                    <div style="margin-bottom: 5px; font-weight: 600;">Kevin Angel User</div>
                    <div style="color: var(--muted); font-size: 13px;"><?php echo $userEmail; ?></div>
                    
                    <a href="https://myaccount.google.com/" target="_blank" class="manage-link" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                        Manage your Google Account
                        <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                    </a>
                    
                    <a href="logout.php" class="signout-btn">Sign Out</a>
                </div>
            </div>

            <div class="content-body">
    <div class="inner-sidebar">
        <div class="inner-search-container">
            <i data-lucide="search" class="search-icon"></i>
            <input type="text" placeholder="Search meetings..." class="inner-search-input">
        </div>

        <button class="inner-btn active" onclick="switchSection('speech-to-text-area')">
            <i data-lucide="video"></i>
            <span>Speech to Text</span>
        </button>

        <button class="inner-btn" onclick="switchSection('voice-record-area')">
            <i data-lucide="mic"></i>
            <span>Record</span>
        </button>

        <div class="inner-divider"></div>
        <small class="section-label">All Meetings</small>
        <div class="meeting-list">
            </div>


            <div class="inner-divider"></div>
    <small class="section-label">All Records</small>
    
    <div id="meeting-list-container" class="meeting-list">
        <p class="empty-msg">No recordings yet.</p>
    </div>
    </div>

    <div class="main-display-area">
        
        <div id="speech-to-text-area" class="content-section">
    <div class="container">
        <h2>Speech to Text</h2>
        <div class="recorder-card">
            <canvas id="visualizer" width="300" height="100"></canvas>
            
            <div id="record-controls">
                <button id="start-btn" class="main-record-btn" onclick="startTranscription()">
                    <span class="pulse-icon">🎙️</span>
                    <p>Start Recording</p>
                </button>
                
                <button id="stop-btn" class="main-record-btn hidden" onclick="stopTranscription()">
                    <span class="stop-icon">🛑</span>
                    <p>Stop & Transcribe</p>
                </button>
            </div>

            <div class="transcript-result-container">
                <div class="result-header">
                    <span>Live Transcript</span>
                    <button class="copy-btn" onclick="copyTranscript()">Copy</button>
                </div>
                <div id="transcript-output" class="transcript-box">
                    <p class="placeholder-text">Click start and say something...</p>
                </div>
            </div>
        </div>
    </div>
</div>

        
        <div id="voice-record-area" class="content-section hidden">
    <div class="container">
        <h2>Voice Recorder</h2>
        <div class="recorder-card">
            <div id="timer-display" class="timer">00:00</div>
            
            <div class="record-actions">
                <button id="v-start-btn" class="action-btn" onclick="startVoiceRecord()">
                    <i data-lucide="mic"></i> Start
                </button>
                
                <button id="v-stop-btn" class="action-btn stop hidden" onclick="stopVoiceRecord()">
                    <i data-lucide="square"></i> Stop
                </button>
            </div>

            <div id="audio-preview-container" class="hidden">
                <div class="inner-divider"></div>
                <p>Preview Recording:</p>
                <audio id="voice-playback" controls></audio>
                <div class="save-actions">
                    <button class="save-btn" onclick="uploadVoiceRecord()">Save to Cloud</button>
                    <button class="discard-btn" onclick="discardRecording()">Discard</button>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>


            <?php include "footer.php"; ?>
        </div>

        <script>
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



















        </script>
        
       
    </body>
     <script src="../script/designs.js"></script>
</html>






