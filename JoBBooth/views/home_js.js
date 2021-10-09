//open dropdown when clicked
document.querySelector('.select-wrapper').addEventListener('click', function() {
    this.querySelector('.select').classList.toggle('open');
})

//select an option from the drop down
for (const option of document.querySelectorAll(".custom-option")) {
    option.addEventListener('click', function() {
        if(this.classList.contains('default')){
            document.querySelector('.select').classList.toggle('open');
            return false;
        }
        else if (!this.classList.contains('selected')) {
            this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
            this.classList.add('selected');
            this.closest('.select').querySelector('.select__trigger span').textContent = this.textContent;
        }
    })
}

//Close the drop down when clicked elsewhere
window.addEventListener('click', function(e) {
    const select = document.querySelector('.select')
    if (!select.contains(e.target)) {
        select.classList.remove('open');
    }
});


//Show password functionality
document.querySelector('.password').addEventListener('input',function(){
    document.getElementById("eyeIcon").style.visibility = "visible";
})

const togglePWD = document.querySelector('#eyeIcon');
const pwd = document.querySelector('.password');

togglePWD.addEventListener('click',function(e){
    const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
    pwd.setAttribute('type',type);

    if(this.classList.contains('fa-eye-slash')){
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
    }
    else{
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
    }
    
});

//restore style settings after incorrect credentials popup
document.querySelector('.username').addEventListener('input',function(){
    if(document.getElementById("userIcon").style.color == "red"){

        document.getElementById("userIcon").style.color = "teal";
        document.getElementById("passIcon").style.color = "teal";
        document.getElementById("uname").style.borderColor = "teal";
        document.getElementById("pwd").style.borderColor = "teal";
        document.getElementById("popup").style.visibility = "hidden";
    }
    
})




