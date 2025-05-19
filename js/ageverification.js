/* -------------------------------------
			AGE CHECK LIEDERLISTE
	-------------------------------------- */
	document.addEventListener('DOMContentLoaded', function () {
		var modal = document.getElementById('ageVerificationModal');
		var form = document.getElementById('ageVerificationForm');
		var message = document.getElementById('ageVerificationMessage');
	
		// Display the modal
		modal.style.display = 'block';
	
		form.addEventListener('submit', function (event) {
			event.preventDefault(); // Prevent form submission
	
			var birthdate = document.getElementById('birthdate').value;
			if (isValidAge(birthdate)) {
				modal.style.display = 'none'; // Close modal if age is valid
			} else {
				message.textContent = 'Du musst 18 Jahre oder älter sein für diese Seite';
				setTimeout(function () {
					window.location.href = 'index.html';
				}, 3000);
			}
		});
	
		function isValidAge(birthdate) {
			var birthDate = new Date(birthdate);
			var today = new Date();
			var age = today.getFullYear() - birthDate.getFullYear();
			var month = today.getMonth() - birthDate.getMonth();
			if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
				age--;
			}
			return age >= 18;
		}
	});