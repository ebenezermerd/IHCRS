$(document).ready(function() {
    // Handle change event of the specialty select element
    $('#speciality').on('change', function() {
      var selectedSpeciality = $(this).val();
  
      // Make an AJAX request to fetch doctors based on the selected specialty
      $.ajax({
        url: 'get-doctors.php',
        type: 'POST',
        data: { Speciality: selectedSpeciality },
        success: function(response) {
          console.log(response);
          var doctors = JSON.parse(response);
          // Clear existing options
          $('#doctor').empty();
          $('#doctor').append('<option value="">Choose doctor</option>');
  
          // Append retrieved doctors to the select element
          doctors.forEach(function(doctor) {
            $('#doctor').append('<option value="' + doctor + '">' + doctor + '</option>');
          });
        }
      });
    });
  });
  