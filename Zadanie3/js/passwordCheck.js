function passwordCheck(event){
    if(document.getElementById('password').value != document.getElementById('passwordConfirmation').value){
        event.preventDefault();
        error('Wrong password', 'Passwords didn\'t match');
    }
}