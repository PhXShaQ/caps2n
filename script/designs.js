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