$(document).ready(function() {
    // Gestion de l'ouverture du modal
    $('#userModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const userType = button.data('user-type');
        $('#userType').val(userType);
    });

    // Soumission du formulaire
    $('#userForm').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: "{{ route('users.store') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const userType = $('#userType').val();
                // Ajout uniquement dans le select concerné
                $(`select[name="${userType}_id"]`).append(
                    `<option value="${response.id}" selected>${response.name}</option>`
                );
                $('#userModal').modal('hide');
                $('#userForm')[0].reset();
            },
            error: function(xhr) {
                alert('Erreur: ' + xhr.responseJSON.message);
            }
        });
    });
});