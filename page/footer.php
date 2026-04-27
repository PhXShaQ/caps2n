<?php

?>
<style>

    body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.footer {
    background: #0b0b0f;
    color: #fff;
    padding: 60px 80px 30px;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

.footer-column {
    width: 18%;
    min-width: 180px;
    margin-bottom: 30px;
    flex: 1 1 180px; 
    
}

.footer-column h3 {
    font-size: 18px;
    margin-bottom: 20px;
    font-weight: 600;
}

.footer-column ul {
    list-style: none;
    padding: 0;
}

.footer-column ul li {
    margin-bottom: 12px;
}

.footer-column ul li a {
    text-decoration: none;
    color: #aaa;
    font-size: 14px;
    transition: 0.3s;
}

.footer-column ul li a:hover {
    color: #fff;
}

.qr {
    width: 100px;
    margin-bottom: 15px;
}

.footer-bottom {
    border-top: 1px solid #222;
    margin-top: 40px;
    padding-top: 20px;
    text-align: center;
    font-size: 14px;
    color: #888;
}

/* Responsive */
@media (max-width: 992px) {
    .footer {
        padding: 40px 20px; 
        text-align: center; 
    }
    .footer-container {
        flex-direction: column;
        align-items: center;
    }

    .footer-column {
        width: 100%;
        margin-bottom: 40px;
    }
    .footer-column ul li {
        margin-bottom: 15px; /* Bigger touch targets for fingers */
    }

    .qr {
        margin: 0 auto 15px; /* Center the QR code */
        display: block;
    }
}
</style>
<footer class="footer">
    <div class="footer-container">

        <!-- Column 1 -->
        <div class="footer-column">
            <h3>Product</h3>
            <ul>
                <li><a href="#">Features</a></li>
                <li><a href="#">AI Notetaker</a></li>
                <li><a href="#">Live Assist</a></li>
                <li><a href="#">Conversation Intelligence</a></li>
                <li><a href="#">Chrome Extension</a></li>
                <li><a href="#">API</a></li>
                <li><a href="#">Pricing</a></li>
            </ul>
        </div>

        <!-- Column 2 -->
        <div class="footer-column">
            <h3>Use Cases</h3>
            <ul>
                <li><a href="#">Sales</a></li>
                <li><a href="#">Recruiting</a></li>
                <li><a href="#">Marketing</a></li>
                <li><a href="#">Collaboration</a></li>
                <li><a href="#">Engineering</a></li>
                <li><a href="#">Healthcare</a></li>
            </ul>
        </div>

        <!-- Column 3 -->
        <div class="footer-column">
            <h3>Integrations</h3>
            <ul>
                <li><a href="#">All Integrations</a></li>
                <li><a href="#">Video Conferencing</a></li>
                <li><a href="#">CRM</a></li>
                <li><a href="#">Storage</a></li>
            </ul>
        </div>

        <!-- Column 4 -->
        <div class="footer-column">
            <h3>Company</h3>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>

        <!-- Column 5 -->
        <div class="footer-column">
            <h3>Scan Me</h3>
            <img src="QR.png" alt="QR Code" class="qr">
            <ul>
                <li><a href="#">Desktop App</a></li>
                <li><a href="#">iOS App</a></li>
                <li><a href="#">Android App</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© <?php echo date("Y"); ?> Kevin Angel's. All rights reserved.</p>
    </div>
</footer>