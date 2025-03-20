/**
 * Employee Data Check - Handles popup notifications for users without employee data
 */
document.addEventListener('DOMContentLoaded', function() {
    // Check if the current user needs to complete employee data
    const employeeDataRequired = document.body.dataset.employeeDataRequired === 'true';
    
    if (employeeDataRequired) {
        // Add click handler to all restricted links and buttons
        document.querySelectorAll('.requires-employee-data').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Show the modal
                const modal = document.getElementById('employee-data-required-modal');
                if (modal) {
                    $(modal).modal('show');
                } else {
                    // Fallback to alert if modal isn't available
                    alert('Anda perlu melengkapi data pegawai terlebih dahulu sebelum mengakses fitur ini.');
                    window.location.href = document.body.dataset.employeeFormUrl || '/employees/create';
                }
            });
        });
        
        // Handle AJAX requests
        $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
            if (jqxhr.status === 403 && jqxhr.responseJSON && jqxhr.responseJSON.error) {
                alert(jqxhr.responseJSON.message);
                if (jqxhr.responseJSON.redirect) {
                    window.location.href = jqxhr.responseJSON.redirect;
                }
            }
        });
    }
}); 