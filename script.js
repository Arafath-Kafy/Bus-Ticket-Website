document.addEventListener("DOMContentLoaded", () => {
  // Send a request to the server to check the user's authentication status
  fetch("/check-authentication.php")
      .then(response => {
          if (response.ok) {
              return response.json();
          } else {
              throw new Error("Failed to check authentication status");
          }
      })
      .then(data => {
          if (data.authenticated) {
              // User is authenticated, show profile, notification, and book now button
              document.getElementById("profile").style.display = "block";
              document.getElementById("notification").style.display = "block";
              document.getElementById("bookNowButton").style.display = "block";
              document.getElementById("loginRegisterButtons").style.display = "none"; // Hide login/register buttons
          } else {
              // User is not authenticated, hide profile, notification, and book now button
              document.getElementById("profile").style.display = "none";
              document.getElementById("notification").style.display = "none";
              document.getElementById("bookNowButton").style.display = "none";
              document.getElementById("loginRegisterButtons").style.display = "block"; // Show login/register buttons
          }
      })
      .catch(error => {
          console.error("Authentication check error:", error);
      });
});
