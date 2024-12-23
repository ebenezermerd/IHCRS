function fetchData(patientId) {
    $.ajax({
      url: 'fetch_data.php',
      type: 'POST',
      data: { patient_id: patientId },
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          // Pre-fill the form inputs
          $('#patient-id').val(response.data.patient_id);
          $('#full-name').val(response.data.full_name);
          $('#surname').val(response.data.surname);
          $('#surgery').val(response.data.surgery);
          $('#phone').val(response.data.phone);
          $('#mobile').val(response.data.mobile);
          $('#fax').val(response.data.fax);
          $('#email').val(response.data.email);
          $('#address-line').val(response.data.address_line);
          $('#postcode').val(response.data.post_code);
          $('#transport-requirement').val(response.data.transport_requirement);
          $('#referral').val(response.data.referral);
          // Disable the form fields to prevent editing
          $('#patient-form input').prop('readonly', true);
          // You can also show a success message if needed
        }
      }
    });
  }

  // Periodically check for updates
  setInterval(function() {
    var patientId = $('#patient-id').val();
    if (patientId !== '') {
      fetchData(patientId);
    }
  }, 5000); // Adjust the interval as needed
