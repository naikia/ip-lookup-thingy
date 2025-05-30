<?php
$ip = $_SERVER['REMOTE_ADDR'];
$apiResponse = file_get_contents("https://ipwhois.app/json/$ip");
$data = json_decode($apiResponse, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IP Lookup</title>
  <link rel="stylesheet" href="./styles/main.css">
  <link rel="icon" href="./assets/favicon.png">
</head>
<body>
  <header>
    <img src="./assets/logo.png" alt="Logo" class="logo">
  </header>
  <main>
    <div class="lookup-box">
      <input type="text" id="ipInput" placeholder="Enter IPv4 (IPV4 ONLY)">
      <button id="lookupBtn">Search</button>
      <div id="results">
        <p>IPv4: <span id="ip"><?php echo $data['ip'] ?? 'N/A'; ?></span></p>
        <p>rDNS: <span id="rdns"><?php echo $data['hostname'] ?? 'N/A'; ?></span></p>
        <p class="small">commonly referred to as Hostname</p>
        <p>City/Province: <span id="city"><?php echo $data['city'] ?? 'N/A'; ?></span></p>
        <p>State: <span id="state"><?php echo $data['region'] ?? 'N/A'; ?></span></p>
        <p>Country: <span id="country"><?php echo $data['country'] ?? 'N/A'; ?></span></p>
        <p>LAT: <span id="lat"><?php echo $data['latitude'] ?? 'N/A'; ?></span></p>
        <p>LONG: <span id="lon"><?php echo $data['longitude'] ?? 'N/A'; ?></span></p>
        <p>Timezone: <span id="timezone"><?php echo $data['timezone_gmt'] ?? 'N/A'; ?></span></p>
        <p>ASN: <span id="asn"><?php echo $data['connection']['asn'] ?? 'N/A'; ?></span></p>
        <p>ISP: <span id="isp"><?php echo $data['connection']['isp'] ?? 'N/A'; ?></span></p>
        <p>Type: <span id="type"><?php echo $data['connection']['type'] ?? 'N/A'; ?></span></p>
      </div>
    </div>
  </main>
  <footer>
    ©2025 Noan Ltd - All Rights Reserved |
    <a href="#" id="privacyLink">Privacy Policy</a>
  </footer>
  <div id="privacyModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>This is a simple IP lookup site and logs nothing. Our source code is located <a href="https://github.com/naikia/ip-lookup-thingy" target="_blank">here</a>.</p>
    </div>
  </div>
  <script>
    const modal = document.getElementById("privacyModal");
    const privacyLink = document.getElementById("privacyLink");
    const closeBtn = document.querySelector(".close");

    privacyLink.addEventListener("click", (e) => {
      e.preventDefault();
      modal.style.display = "block";
    });

    closeBtn.onclick = () => {
      modal.style.display = "none";
    };

    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };

    document.getElementById("lookupBtn").addEventListener("click", () => {
      const ip = document.getElementById("ipInput").value.trim();
      if (/^(\d{1,3}\.){3}\d{1,3}$/.test(ip)) {
        window.location.href = `?ip=${ip}`;
      } else {
        alert("Please enter a valid IPv4 address.");
      }
    });
  </script>
</body>
</html>
