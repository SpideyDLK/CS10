
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






