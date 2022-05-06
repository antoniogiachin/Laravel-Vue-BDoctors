const deleteProfile = document.querySelectorAll('.delete-profile');
deleteProfile.forEach(form => {
    const name = form.getAttribute('data-name');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const accept = confirm(`Sicuro di voler cancellare definitivamente il suo profilo Dott. ${name}?`);
        if(accept)e.target.submit();
    })
})

// delete user
const deleteUser = document.getElementById('deleteUser');
deleteUser.addEventListener('click', (e)=>{
    if(!confirm('Vuoi davvero cancellare il tuo profilo? (Se cambi idea dovrai registrarti di nuovo!')){
        e.preventDefault();
    }
})
