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
        <link rel="stylesheet" href="../css/design1.css">
        
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
       
    </body>
     <script src="../script/design1.js"></script>
</html>






