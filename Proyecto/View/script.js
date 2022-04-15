function side(){
    body = document.querySelector('body');
    toggle = body.querySelector(".toggle");
    sidebar = body.querySelector('nav');
    searchBtn = body.querySelector(".search-box");

    toggle.addEventListener("click" , () =>{
        sidebar.classList.toggle("close");
    })
}

function mode(){   
    body = document.querySelector('body'); 
    modeSwitch = body.querySelector(".toggle-switch");
    modeText = body.querySelector(".mode-text");

    modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark");
        
        if(body.classList.contains("dark")){
            modeText.innerText = "Light mode";
        }else{
            modeText.innerText = "Dark mode";
        }
    });
}

function login(){
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("form .signup-link a");
    signupBtn.onclick = (()=>{
      loginForm.style.marginLeft = "-50%";
      loginText.style.marginLeft = "-50%";
    });
    loginBtn.onclick = (()=>{
      loginForm.style.marginLeft = "0%";
      loginText.style.marginLeft = "0%";
    });
    signupLink.onclick = (()=>{
      signupBtn.click();
      return false;
    });
}








