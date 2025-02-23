document.addEventListener('DOMContentLoaded', function() {
    const addButtons = document.querySelectorAll('.add-user-btn');
    const modal = document.getElementById('addUserModal');
    const form = document.getElementById('addUserForm');
    const selectElements = document.querySelectorAll('.user-select'); // All user select elements

    addButtons.forEach(button => {
        button.addEventListener('click', () => {
            alert('clicked');
            modal.classList.remove('hidden');
        });
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch('/users', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                const data = await response.json();
                
                // Update all user select elements with the new user
                selectElements.forEach(select => {
                    const option = new Option(data.name, data.id);
                    select.add(option);
                    select.value = data.id; // Select the newly added user
                });

                closeModal();
                form.reset();
            } else {
                const errors = await response.json();
                // Handle validation errors
                Object.keys(errors).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.classList.add('border-red-500');
                    }
                });
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});

function closeModal() {
    const modal = document.getElementById('addUserModal');
    modal.classList.add('hidden');
}