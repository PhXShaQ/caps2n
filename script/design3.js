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


    const fileInput = document.getElementById('audioFileInput');
const dropArea = document.getElementById('dropArea');
const fileNameDisplay = document.getElementById('fileNameDisplay');
const transcribeModal = document.getElementById('transcribeModal');

// Open/Close Modal Functions
function openTranscribeModal() { transcribeModal.style.display = 'flex'; }
function closeTranscribeModal() { transcribeModal.style.display = 'none'; }

// Trigger file input when clicking the dashed area
dropArea.onclick = () => fileInput.click();

// Show file name when selected
fileInput.onchange = ({target}) => {
    if (target.files.length > 0) {
        fileNameDisplay.innerText = `Selected: ${target.files[0].name}`;
        fileNameDisplay.style.color = "#007bff";
    }
};

// --- THE FUNCTIONAL PART ---
async function processTranscription() {
    const fileInput = document.getElementById('audioFileInput');
    const btn = document.getElementById('transcribeBtn');
    
    if (!fileInput.files[0]) return alert("Select a file!");

    btn.disabled = true;
    btn.innerText = "TRANSCRIBING...";

    const formData = new FormData();
    formData.append('audio', fileInput.files[0]);
    formData.append('language', document.getElementById('audioLang').value);

    try {
        const response = await fetch('transcribe.php', {
            method: 'POST',
            body: formData
        });

        // This converts the response from PHP into a JS object
        const data = await response.json();

        if (data.text) {
            // 1. Hide the modal
            closeTranscribeModal();
            
            // 2. Show the result container
            document.getElementById('resultContainer').style.display = 'block';
            
            // 3. Put the text inside the div (not a download)
            document.getElementById('resultText').innerText = data.text;
        } else {
            alert("Error: " + (data.error || "Check API Key/Balance"));
        }
    } catch (e) {
        console.error(e);
        alert("Server Error. Make sure transcribe.php is in the correct folder.");
    } finally {
        btn.disabled = false;
        btn.innerText = "TRANSCRIBE";
    }
}

// Optional: Helper function to copy the result
function copyText() {
    const text = document.getElementById('resultText').innerText;
    navigator.clipboard.writeText(text);
    alert("Copied to clipboard!");
}

    


