function verifyPassword(event) {
    event.preventDefault();
    var correctPassword = "12345678!";
    var userPassword    = prompt("Bitte geben Sie das Passwort ein, um die Fotos zu sehen:");
    if (userPassword === correctPassword) {
        window.open(event.currentTarget.href, '_blank');
    } else {
        alert("Falsches Passwort. Zugriff verweigert.");
    }
}
